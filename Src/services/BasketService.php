<?

namespace App\Services;
use App\Repositories\BasketRepository;

class BasketService {
    private $basketRepository;

    public function __construct(BasketRepository $basketRepository) {
        $this->basketRepository = $basketRepository;
    }
    public function getBasketByUserId($userId) {
        return $this->basketRepository->getBasketByUserId($userId);
    }
}