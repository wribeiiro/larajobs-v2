<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\VacancyJob;
use Validator;

class VacancyJobController extends Controller
{
    /**
     * Retrieve all jobs
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => VacancyJob::latest()->filter(request(['tag', 'search']))->paginate(6),
            'message' => Response::$statusTexts[Response::HTTP_OK],
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    /**
    * Show the specified job.
    *
    * @param string $uuid
    * @return \Illuminate\Http\Response
    */
    public function show(string $uuid)
    {
        return response()->json([
            'data' => VacancyJob::find($uuid),
            'message' => Response::$statusTexts[Response::HTTP_OK],
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    /**
     * Create a job
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $jobData = $request->all();

        $jobValidator = Validator::make($jobData, [
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required',
            'level' => 'required',
            'contract' => 'required',
            'salary_range' => 'required'
        ]);

        if ($jobValidator->fails()){
            return response()->json([
                'data' => null,
                'message' => $jobValidator->errors(),
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($request->hasFile('logo')) {
            $jobData['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $jobData['user_id'] = auth()->id();

        $createdJob = VacancyJob::create($jobData);

        $jobData['id'] = $createdJob->id;

        return response()->json([
            'data' => $jobData,
            'message' => 'Job was created with success.',
            'status' => Response::HTTP_CREATED
        ], Response::HTTP_CREATED);
    }

    /**
     * Update a job
     *
     * @param Request $request
     * @param string $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $uuid): \Illuminate\Http\JsonResponse
    {
        $job = VacancyJob::find($uuid);

        if ($job === null) {
            return response()->json([
                'data' => null,
                'message' => 'Job was not found.',
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        }

        if ($job->user_id != auth()->id()) {
            return response()->json([
                'data' => null,
                'message' => Response::$statusTexts[Response::HTTP_FORBIDDEN],
                'status' => Response::HTTP_FORBIDDEN
            ], Response::HTTP_FORBIDDEN);
        }

        $jobData = $request->all();

        if ($request->hasFile('logo')) {
            $jobData['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $jobData['uuid'] = $job->id;

        $job->update($jobData);

        return response()->json([
            'data' => $jobData,
            'message' => 'Job was updated with success.',
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }

    /**
     * Destroy a job
     *
     * @param string $job
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $uuid): \Illuminate\Http\JsonResponse
    {
        $job = VacancyJob::find($uuid);

        if ($job === null) {
            return response()->json([
                'data' => null,
                'message' => 'Job was not found.',
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        }

        if ($job->user_id != auth()->id()) {
            return response()->json([
                'data' => null,
                'message' => Response::$statusTexts[Response::HTTP_FORBIDDEN],
                'status' => Response::HTTP_FORBIDDEN
            ], Response::HTTP_FORBIDDEN);
        }

        $job->delete();

        return response()->json([
            'data' => $job,
            'message' => 'Job was deleted with success.',
            'status' => Response::HTTP_NO_CONTENT
        ], Response::HTTP_NO_CONTENT);
    }
}
