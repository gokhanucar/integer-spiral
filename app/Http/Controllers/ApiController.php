<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Integer Spiral Case Solution Documentation",
 *      description="Gökhan Uçar - Integral Spiral Api Case Solution",
 *      @OA\Contact(
 *          email="gokhanucar@outlook.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Demo API Server"
 * )
 *
 * @OA\Tag(
 *     name="Layouts",
 *     description="API Endpoints of Layouts"
 * )
 *
 */
class ApiController extends Controller
{
    use ApiResponser;
}
