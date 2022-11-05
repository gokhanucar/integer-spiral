<?php

namespace App\Services;

use App\Repositories\IRepositories\ILayoutRepository;
use Illuminate\Database\Eloquent\Collection;

class LayoutService
{
    /**
     * @var ILayoutRepository $layoutRepository
     */
    protected ILayoutRepository $layoutRepository;

    /**
     * LayoutService constructor.
     *
     * @param ILayoutRepository $layoutRepository
     */
    public function __construct(ILayoutRepository $layoutRepository)
    {
        $this->layoutRepository = $layoutRepository;
    }

    /**
     * Create layout record to storage
     *
     * @param int $x
     * @param int $y
     * @return int
     */
    public function createLayout(int $x, int $y): int
    {
        $emptyArray = defineArray($y, $x);
        $matrix = fillArray($emptyArray);

        $layout = $this->layoutRepository->create([
            'x' => $x,
            'y' => $y,
            'output' => $matrix
        ]);

        return $layout->layoutId;
    }

    /**
     * Get all layouts
     *
     * @return Collection
     */
    public function getLayouts(): Collection
    {
        return $this->layoutRepository->all("layoutId", "desc", ["layoutId", "x", "y"]);
    }

    /**
     * Get layout by primary key
     *
     * @param int $layoutId
     * @return array
     */
    public function getLayout(int $layoutId): array
    {
        $record = $this->layoutRepository->find($layoutId);
        if ($record) {
            return $record->toArray();
        }

        return false;
    }

    /**
     * Get value of given coordinates of layout
     *
     * @param int $layoutId
     * @param int $x
     * @param int $y
     * @return int
     */
    public function getValue(int $layoutId, int $x, int $y): int
    {
        $layout = $this->getLayout($layoutId);
        if ($layout) {
            $output = $layout['output'];
            if (count($output) < $y || count($output[0]) < $x) {
                throw new \OutOfBoundsException("You have exceeded the boundary conditions of the respective layout", 400);
            }
            return $output[$y][$x];
        }

        return false;
    }
}
