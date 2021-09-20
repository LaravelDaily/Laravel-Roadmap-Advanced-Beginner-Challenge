<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{

    /**
     * Remove the specified resource from storage.
     *
     * @param  Response  $response
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Response $response)
    {
        $this->authorize('delete', $response);

        $response->delete();

        return response()->json(['message' => 'Response deleted']);
    }
}
