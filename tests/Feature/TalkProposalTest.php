<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\TalkProposal;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class TalkProposalTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test to check if a talk proposal can be created successfully.
     */
    public function test_can_create_talk_proposal()
    {
        // Simulate a logged-in speaker
        $speaker = User::factory()->create();

        // Simulate file storage
        Storage::fake('local');

        $file = UploadedFile::fake()->create('presentation.pdf', 1000, 'application/pdf');

        // Define the data to be submitted
        $data = [
            'title' => 'Test Proposal',
            'description' => 'This is a test description for the proposal.',
            'tags' => 'technology,health',
            'pdf_file' => $file
        ];

        // Act as the authenticated speaker
        $this->actingAs($speaker);

        // Make a POST request to store the talk proposal
        $response = $this->post(route('talkproposal.store'), $data);

        // Assert the talk proposal is stored in the database
        $this->assertDatabaseHas('talk_proposals', [
            'title' => 'Test Proposal',
            'description' => 'This is a test description for the proposal.',
            'tags' => json_encode(['technology', 'health']), // Make sure the tags are stored correctly as JSON
        ]);

        // Check if the file is stored correctly
        Storage::disk('local')->assertExists('proposals/' . $file->hashName());

        // Assert the redirection to the appropriate route
        $response->assertRedirect(route('talkproposal.index'));
    }

    /**
     * Test to ensure talk proposal validation fails for invalid data.
     */
    public function test_talk_proposal_validation_fails()
    {
        // Simulate a logged-in speaker
        $speaker = User::factory()->create();

        // Act as the authenticated speaker
        $this->actingAs($speaker);

        // Send empty data to trigger validation failure
        $response = $this->post(route('talkproposal.store'), []);

        // Assert validation errors
        $response->assertSessionHasErrors(['title', 'description', 'tags', 'pdf_file']);
    }

    /**
     * Test to check the relationship between TalkProposal and Speaker.
     */
    public function test_talk_proposal_belongs_to_speaker()
    {
        // Create a speaker
        $speaker = User::factory()->create();

        // Create a talk proposal for the speaker
        $talkProposal = TalkProposal::factory()->create([
            'speaker_id' => $speaker->id,
        ]);

        // Assert that the talk proposal belongs to the speaker
        $this->assertTrue($talkProposal->speaker->is($speaker));
    }
}
