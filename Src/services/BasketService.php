<?

namespace App\Services;
use App\Repositories\BasketRepository;

class BasketService {
    private $repo;

    public function __construct(BasketRepository $repo) {
        $this->repo = $repo;
    }
    public function getBasketByUserId($userId) {
        return $this->repo->getBasketByUserId($userId);
    }
}