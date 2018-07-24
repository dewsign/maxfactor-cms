<?php

namespace Maxfactor\CMS\Http\Admin\Controllers;

use Illuminate\Http\Request;
use Maxfactor\CMS\Facades\ImageStore;
use Maxfactor\CMS\Http\Controllers\Controller;

class ImageAdminController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  string  $options
     * @param  string  $image_id
     * @param  string  $image_ext
     * @return \Illuminate\Http\Response
     */
    public function show(string $options, string $image_id, string $image_ext)
    {
        return redirect(
            ImageStore::getUrl(
                $image_id.'.'.$image_ext,
                array_merge(
                    $this->getImageStoreOptionsFromRequestOptions($options),
                    [
                        'secure' => true,
                    ]
                )
            ),
            301
        );
    }

    /**
     * Translate options passed into array format suitable for ImageStore
     *
     * @param  string  $requestOptions
     * @return array
     */
    protected function getImageStoreOptionsFromRequestOptions(string $requestOptions)
    {
        $parsedOptions = [];

        $requestOptionMapping = [
            'w' => 'width',
            'h' => 'height',
            'c' => 'crop',
        ];

        foreach (explode('_', $requestOptions) as $requestOption) {
            $optionLetter = $requestOption[0];
            $optionValue = substr($requestOption, 1);

            if (isset($requestOptionMapping[$optionLetter])) {
                $parsedOptions[$requestOptionMapping[$optionLetter]] = $optionValue;
            }
        }

        return $parsedOptions;
    }

    /**
     * Upload an image
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->hasFile('image') || !$request->image->isValid()) {
            abort(422);
        }

        // Pass image path and original file name without extention to image store
        $imageUploadResponse = ImageStore::store(
            $request->image->getPathName(),
            pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME)
        );

        if ($imageUploadResponse == null) {
            abort(500);
        }

        return [
            'image_id' => $imageUploadResponse['image_id'],
            'image_ext' => $imageUploadResponse['image_ext'],
            'image_size' => $imageUploadResponse['image_size'],
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $image_id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $image_id)
    {
        ImageStore::destroy($image_id);

        return response()->json([
            'message' => 'Successfully deleted image',
        ]);
    }
}
