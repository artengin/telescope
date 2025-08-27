<?php

namespace Laravel\Telescope\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Laravel\Telescope\Contracts\ClearableRepository;
use Laravel\Telescope\EntryType;
use Laravel\Telescope\Storage\DatabaseEntriesRepository;

class EntriesController extends Controller
{
    /**
     * Delete all of the entries from storage.
     *
     * @param  \Laravel\Telescope\Contracts\ClearableRepository  $storage
     * @return void
     */
    public function destroy(ClearableRepository $storage)
    {
        $storage->clear();
    }

    /**
     * Return the count of entries for the current entry type as a JSON response.
     *
     * @param \Laravel\Telescope\Storage\DatabaseEntriesRepository $storage
     * @return \Illuminate\Http\JsonResponse JSON response containing the count of entries.
     */
    public function count(DatabaseEntriesRepository $storage): JsonResponse
    {
        return response()->json([
            'requests' => $storage->getCount(EntryType::REQUEST),
            'commands' => $storage->getCount(EntryType::COMMAND),
        ]);
    }
}
