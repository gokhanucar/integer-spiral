<?php

namespace App\Http\Controllers;

use App\Services\LayoutService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LayoutController extends ApiController
{
    private LayoutService $layoutService;

    public function __construct(LayoutService $layoutService)
    {
        $this->layoutService = $layoutService;
    }

    /**
     * @OA\Get(
     *      path="/layouts",
     *      operationId="getLayouts",
     *      tags={"Layouts"},
     *      summary="List all layouts",
     *      description="List all layouts including data (x, y, layoutId)",
     *      @OA\Response(
     *          response=200,
     *          description="Successful Operation"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Server Error"
     *      )
     * )
     */
    public function index()
    {
        try {
            return $this->showAll($this->layoutService->getLayouts());
        } catch (\Exception $e) {
            return $this->errorResponse("Server error", 500);
        }
    }


    /**
     * @OA\Post(
     *      path="/layouts",
     *      operationId="createLayout",
     *      tags={"Layouts"},
     *      summary="Create new layout record",
     *      description="Create two dimensional layout record with spiral algorithm. Returns layout id",
     *      @OA\RequestBody(
     *          description="Two dimensional layout to create",
     *          @OA\MediaType(
     *              mediaType="application/json",
     *              @OA\Schema(
     *                  type="object",
     *                  @OA\Property(
     *                      property="x",
     *                      description="Column count of layout",
     *                      type="integer",
     *                  ),
     *                  @OA\Property(
     *                      property="y",
     *                      description="Row count of layout",
     *                      type="integer"
     *                  )
     *              )
     *          )
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful Operation"
     *      ),
     *      @OA\Response(
     *          response=412,
     *          description="Bad request with invalid arguments",
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Server Error"
     *      )
     * )
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'x' => 'required|integer|min:1',
            'y' => 'required|integer|min:1'
        ]);

        try {
            if ($validator->fails()) {
                throw new \InvalidArgumentException($validator->errors()->first(), 412);
            }

            $validated = $validator->validated();
            $layoutId = $this->layoutService->createLayout($validated['x'], $validated['y']);
        } catch (\InvalidArgumentException $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        } catch (\Exception $e) {
            return $this->errorResponse("Server error", 500);
        }

        return $this->showArray(['layoutId' => $layoutId], 201);
    }


    /**
     * @OA\Get(
     *      path="/layouts/value/{layoutId}",
     *      operationId="getValue",
     *      tags={"Layouts"},
     *      summary="Get value of given coordinates from specified layout",
     *      description="NOTE THAT the starting indices of both rows and columns are zero",
     *      @OA\Parameter(
     *          name="layoutId",
     *          description="Layout id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="x",
     *          description="Column coordinate (starting with zero)",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="y",
     *          description="Row coordinate (starting with zero)",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful Operation"
     *      ),
     *      @OA\Response(
     *          response=412,
     *          description="Bad request with invalid arguments"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Model Not Found"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Server Error"
     *      )
     * )
     */
    public function getValue(Request $request, int $layoutId)
    {
        $params = $request->query();

        $validator = Validator::make($params, [
            'x' => 'required|integer|min:1',
            'y' => 'required|integer|min:1'
        ]);

        try {
            if ($validator->fails()) {
                throw new \InvalidArgumentException($validator->errors()->first(), 412);
            }

            $validated = $validator->validated();
            $value = $this->layoutService->getValue($layoutId, $validated['x'], $validated['y']);
        } catch (\InvalidArgumentException $e) {
            return $this->errorResponse($e->getMessage(), $e->getCode());
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse($e->getMessage(), 404);
        } catch (\Exception $e) {
            return $this->errorResponse("Server error", 500);
        }

        return $this->showArray(['value' => $value]);
    }

    /**
     * @OA\Get(
     *      path="/layouts/{id}",
     *      operationId="getLayout",
     *      tags={"Layouts"},
     *      summary="Fetch single layout record by layoutId",
     *      description="Fetch single layout record with decoded output data by layoutId",
     *      @OA\Parameter(
     *          name="id",
     *          description="Layout id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful Operation"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Model Not Found"
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="Server Error"
     *      )
     * )
     */
    public function show($id)
    {
        try {
            $result = $this->layoutService->getLayout($id);
        } catch (ModelNotFoundException $e) {
            return $this->errorResponse($e->getMessage(), 404);
        } catch (\Exception $e) {
            return $this->errorResponse("Server error", 500);
        }

        return $this->showArray($result);
    }
}
