<?php

namespace App\Http\Controllers;

use App\Mail\BespokeBraceletMail;
use App\Mail\BespokeEaringMail;
use App\Mail\BespokeNecklaceMail;
use App\Mail\BespokeRingMail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BespokeController extends Controller
{
    public function bespokeRing(Request $request)
    {
        try {
            $validated = $request->validate([
                'aaraRingType'                => 'required',
                'aaraRingCenterStone'         => 'required',
                'aaraRingCenterStoneMaterial' => 'required',
                'aaraRingSideDiamond'         => 'nullable',
                'aaraRingCenterSettings'      => 'required',
                'aaraRingShankStyle'          => 'required',
                'ringSize'       => 'required',
                'customization'  => 'required',
                'userName'       => 'required',
                'userEmail'      => 'required',
                'color'          => 'required',
                'material'       => 'required',
                'minBudget'      => 'nullable|numeric',
                'maxBudget'      => 'nullable|numeric',
                'userPhone'      => 'nullable',
                'referenceImage' => 'nullable|image', // Validating optional image input
            ]);
            $data = [
                'ringType'            => $request->aaraRingType ?: '-',
                'centerStone'         => $request->aaraRingCenterStone ?: '-',
                'centerStoneMaterial' => $request->aaraRingCenterStoneMaterial ?: '-',
                'sideDiamond'         => $request->aaraRingSideDiamond ?: '-',
                'centerSettings'      => $request->aaraRingCenterSettings ?: '-',
                'shankStyle'          => $request->aaraRingShankStyle ?: '-',
                'color'               => $request->color ?: '-',
                'material'            => $request->material ?: '-',
                'ringSize'            => $request->ringSize ?: '-',
                'customization'       => $request->customization ?: '-',
                'minBudget'           => $request->minBudget ?: '-',
                'maxBudget'           => $request->maxBudget ?: '-',
                'userName'            => $request->userName ?: '-',
                'userEmail'           => $request->userEmail ?: '-',
                'userPhone'           => $request->userPhone ?: '-'
            ];


            // Handle the reference image if present
            if (isset($validated['referenceImage'])) {
                // Save the image in the 'public' disk (or any disk you prefer)
                $path = $validated['referenceImage']->store('reference-images', 'public');
                // Log the saved path
                Log::info('Bespoke Ring - Reference Image saved at: ' . $path);
                $originalName = $validated['referenceImage']->getClientOriginalName();

                // You might want to add the path to your data array if needed for the email
                $data['referenceImagePath'] = $path;
                $data['originalName']       = $originalName;
            }
            Log::info('Bespoke Ring - All data -> '.json_encode($data));

            $data['headerText']       = "New bespoke ring request received";
            Mail::to('aarajewelryco@gmail.com')->send(new BespokeRingMail($data));

            $data['headerText']       = "Your bespoke ring request has been received";
            Mail::to($data['userEmail'])->send(new BespokeRingMail($data));

            return response()->json(['message' => 'Email sent successfully!']);
        } catch (Exception $e) {
            Log::error("Bespoke ring error -> ".$e);
        }
    }

    public function bespokeEaring(Request $request)
    {
        try {
            $validated = $request->validate([
                'aaraEaringStone'     => 'required',
                'aaraEaringStyleType' => 'required',
                'customization'  => 'required',
                'userName'       => 'required',
                'userEmail'      => 'required',
                'color'          => 'required',
                'material'       => 'required',
                'minBudget'      => 'nullable|numeric',
                'maxBudget'      => 'nullable|numeric',
                'userPhone'      => 'nullable',
                'referenceImage' => 'nullable|image', // Validating optional image input
            ]);
            $data = [
                'stone'         => $request->aaraEaringStone ?: '-',
                'styleType'     => $request->aaraEaringStyleType ?: '-',
                'color'         => $request->color ?: '-',
                'material'      => $request->material ?: '-',
                'customization' => $request->customization ?: '-',
                'minBudget'     => $request->minBudget ?: '-',
                'maxBudget'     => $request->maxBudget ?: '-',
                'userName'      => $request->userName ?: '-',
                'userEmail'     => $request->userEmail ?: '-',
                'userPhone'     => $request->userPhone ?: '-'
            ];

            // Handle the reference image if present
            if (isset($validated['referenceImage'])) {
                // Save the image in the 'public' disk (or any disk you prefer)
                $path = $validated['referenceImage']->store('reference-images', 'public');
                // Log the saved path
                Log::info('Bespoke Earing - Reference Image saved at: ' . $path);
                $originalName = $validated['referenceImage']->getClientOriginalName();

                // You might want to add the path to your data array if needed for the email
                $data['referenceImagePath'] = $path;
                $data['originalName']       = $originalName;
            }
            Log::info('Bespoke Earing - All data -> '.json_encode($data));

            $data['headerText']       = "New bespoke earing request received";
            Mail::to('aarajewelryco@gmail.com')->send(new BespokeEaringMail($data));

            $data['headerText']       = "Your bespoke earing request has been received";
            Mail::to($data['userEmail'])->send(new BespokeEaringMail($data));

            return response()->json(['message' => 'Email sent successfully!']);
        } catch (Exception $e) {
            Log::error("Bespoke earing error -> ".$e);
        }
    }

    public function bespokeBracelet(Request $request)
    {
        try {
            $validated = $request->validate([
                'aaraBraceletDiamondCut'   => 'required',
                'style'          => 'required',
                'gender'         => 'required',
                'braceletSize'   => 'required',
                'customization'  => 'required',
                'userName'       => 'required',
                'userEmail'      => 'required',
                'userPhone'      => 'nullable',
                'referenceImage' => 'nullable|image',
            ]);
            $data = [
                'diamondCut'    => $request->aaraBraceletDiamondCut ?: '-',
                'style'         => $request->style ?: '-',
                'gender'        => $request->gender ?: '-',
                'braceletSize'  => $request->braceletSize ?: '-',
                'customization' => $request->customization ?: '-',
                'userName'      => $request->userName ?: '-',
                'userEmail'     => $request->userEmail ?: '-',
                'userPhone'     => $request->userPhone ?: '-'
            ];

            // Handle the reference image if present
            if (isset($validated['referenceImage'])) {
                // Save the image in the 'public' disk (or any disk you prefer)
                $path = $validated['referenceImage']->store('reference-images', 'public');
                // Log the saved path
                Log::info('Bespoke Bracelet - Reference Image saved at: ' . $path);
                $originalName = $validated['referenceImage']->getClientOriginalName();

                // You might want to add the path to your data array if needed for the email
                $data['referenceImagePath'] = $path;
                $data['originalName']       = $originalName;
            }
            Log::info('Bespoke Bracelet - All data -> '.json_encode($data));

            $data['headerText']       = "New bespoke bracelet request received";
            Mail::to('aarajewelryco@gmail.com')->send(new BespokeBraceletMail($data));

            $data['headerText']       = "Your bespoke bracelet request has been received";
            Mail::to($data['userEmail'])->send(new BespokeBraceletMail($data));

            return response()->json(['message' => 'Email sent successfully!']);
        } catch (Exception $e) {
            Log::error("Bespoke bracelet error -> ".$e);
        }
    }

    public function bespokeNecklace(Request $request)
    {
        try {
            $validated = $request->validate([
                'customization'  => 'required',
                'userName'       => 'required',
                'userEmail'      => 'required',
                'color'          => 'required',
                'material'       => 'required',
                'minBudget'      => 'nullable|numeric',
                'maxBudget'      => 'nullable|numeric',
                'userPhone'      => 'nullable',
                'referenceImage' => 'nullable|image', // Validating optional image input
            ]);
            $data = [
                'color'         => $request->color ?: '-',
                'material'      => $request->material ?: '-',
                'customization' => $request->customization ?: '-',
                'minBudget'     => $request->minBudget ?: '-',
                'maxBudget'     => $request->maxBudget ?: '-',
                'userName'      => $request->userName ?: '-',
                'userEmail'     => $request->userEmail ?: '-',
                'userPhone'     => $request->userPhone ?: '-'
            ];

            // Handle the reference image if present
            if (isset($validated['referenceImage'])) {
                // Save the image in the 'public' disk (or any disk you prefer)
                $path = $validated['referenceImage']->store('reference-images', 'public');
                // Log the saved path
                Log::info('Bespoke Necklace - Reference Image saved at: ' . $path);
                $originalName = $validated['referenceImage']->getClientOriginalName();

                // You might want to add the path to your data array if needed for the email
                $data['referenceImagePath'] = $path;
                $data['originalName']       = $originalName;
            }
            Log::info('Bespoke Necklace - All data -> '.json_encode($data));

            $data['headerText']       = "New bespoke necklace request received";
            Mail::to('aarajewelryco@gmail.com')->send(new BespokeNecklaceMail($data));

            $data['headerText']       = "Your bespoke necklace request has been received";
            Mail::to($data['userEmail'])->send(new BespokeNecklaceMail($data));

            return response()->json(['message' => 'Email sent successfully!']);
        } catch (Exception $e) {
            Log::error("Bespoke necklace error -> ".$e);
        }
    }
}
