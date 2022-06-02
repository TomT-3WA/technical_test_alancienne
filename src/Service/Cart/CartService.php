<?php

namespace App\Service\Cart;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService
{
    private $requestStack;
    private $productRepository;

    public function __construct(RequestStack $requestStack, ProductRepository $productRepository)
    {
        $this->requestStack = $requestStack;
        $this->productRepository = $productRepository;
    }

    public function add(int $id)
    {
        $session = $this->requestStack->getSession();

        $panier = $session->get('panier', []);

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }

        $session->set('panier', $panier);
    }

    public function remove(int $id)
    {
        $session = $this->requestStack->getSession();

        $panier = $this->session->get('panier', []);

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        $session->set('panier', $panier);
    }

    public function getFullCart(): array
    {
        $session = $this->requestStack->getSession();

        $panier = $session->get('panier', []);

        $panierWithData = [];

        foreach ($panier as $id => $quantity) {
            $panierWithData[] = [
                'product' => $this->productRepository->find($id),
                'quantity' => $quantity
            ];
        }

        return $panierWithData;
    }

    public function calculPrixTTC(Product $product)
    {
        $prixHT = $product->getPriceDutyFree();
        $tva = $product->getTVA();
        $prixTTC = ($prixHT * $tva) + $prixHT;

        return $prixTTC;
    }

    public function getTotal(): float
    {

        $total = 0;

        foreach ($this->getFullCart() as $item) {
            $total += $this->calculPrixTTC($item['product']) * $item['quantity'];
        }

        return $total;
    }
}
