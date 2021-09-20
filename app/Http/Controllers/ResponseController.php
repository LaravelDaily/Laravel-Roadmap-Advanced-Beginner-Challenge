<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddResponseToTaskRequest;
use App\Models\Response;
use Illuminate\Http\Request;

class ResponseController extends Controller
{

    /**
     * Remove the specified resource from storage.
     *
     * @param  Response  $response
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Response $response)
    {
        $this->authorize('delete', $response);

        $response->delete();

        return redirect()->back()->with('responseDeleted', true);
    }
}
