<?php

namespace App\Http\Controllers;

use App\Actions\PaydayAction;
use Illuminate\Http\Response;

class PaydayController extends Controller
{
    public function store(PaydayAction $paydayAction): Response
    {
        $paydayAction->execute();

        return response()->noContent();
    }
}
