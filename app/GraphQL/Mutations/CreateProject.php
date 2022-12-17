<?php

namespace App\GraphQL\Mutations;

use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\AuthManager;
use Illuminate\Contracts\Config\Repository as Config;
use Illuminate\Support\Arr;

final class CreateProject
{
    protected Project $project;
    protected int $user_id;

    public function __construct(Project $project)
    {
        $this->project = $project;
    }

    /**
     * Return a value for the field.
     *
     * @param  null  $_ Usually contains the result returned from the parent field.
     *  In this case, it is always `null`.
     * @param  mixed[]  $args The arguments that were passed into the field.
     * @return mixed
     */
    public function resolve($_, array $args): string
    {
        /**
        mutation {
            createProject(input: {
                name: "Woods"
                description: "We produce high quality woods"
                lat: 40.00
                long: 45.55
                file: [object]
            }) {
                id
            }
        }
         */

        $this->user_id = auth()->user()->getAuthIdentifier();
        if(!$this->user_id) {
            return response()->json(['error' => 'Not Authorized'], 403);
        }

        // save project image
        /** @var \Illuminate\Http\UploadedFile $file */
        $file = $args['file'];
        $image_path = $file->storePublicly('uploads');

        // assign $args to Project
        $project = Project::create($this->initModel($args, $image_path));

        return $project->id;
    }

    /**
     * @param array<string, mixed> $args
     * @param string $image_path
     * @return array<string, string>
     */
    protected function initModel(array $args, string $image_path): array
    {
        return [
            'name' => $args['name'] ?? '',
            'description' => $args['description'] ?? '',
            'lat' => (float) $args['lat'] ?? 0,
            'lon' => (float) $args['long'] ?? 0,
            'date'=> date('Y-m-d H:i:s', time()),
            'image_path' => '/public/' . $image_path,
            'user_id' => $this->user_id
        ];
    }
}
