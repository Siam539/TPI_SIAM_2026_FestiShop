<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $anniversaire  = Category::firstWhere('slug', 'anniversaire')->id;
        $mariage       = Category::firstWhere('slug', 'mariage')->id;
        $prenatal      = Category::firstWhere('slug', 'prenatal')->id;
        $noel          = Category::firstWhere('slug', 'noel')->id;
        $halloween     = Category::firstWhere('slug', 'halloween')->id;

        $products = [
            // Anniversaire
            [
                'category_id' => $anniversaire,
                'name'        => 'Kit Décoration Anniversaire Cyan',
                'slug'        => 'kit-decoration-anniversaire-cyan',
                'description' => 'Kit complet : pompons en papier, guirlande "Happy Birthday" et franges dorées. Couleurs cyan, or et blanc.',
                'price'       => 18,
                'stock'       => 25,
                'is_active'   => true,
                'image'       => 'images/products/Cyan_set.png',
            ],
            [
                'category_id' => $anniversaire,
                'name'        => 'Kit Décoration Anniversaire Bleu',
                'slug'        => 'kit-decoration-anniversaire-bleu',
                'description' => 'Kit ballons et guirlande "Happy Birthday" en bleu marine, bleu ciel et argent avec franges.',
                'price'       => 16,
                'stock'       => 30,
                'is_active'   => true,
                'image'       => 'images/products/Blue_set.png',
            ],
            [
                'category_id' => $anniversaire,
                'name'        => 'Ballons Happy Birthday Or & Noir',
                'slug'        => 'ballons-happy-birthday-or-noir',
                'description' => 'Bouquet de 5 ballons dorés et noirs avec inscription "Happy Birthday". Élégant et festif.',
                'price'       => 9,
                'stock'       => 50,
                'is_active'   => true,
                'image'       => 'images/products/Baloon_Set.png',
            ],
            [
                'category_id' => $anniversaire,
                'name'        => 'Kit Guirlande & Ballons Dorés',
                'slug'        => 'kit-guirlande-ballons-dores',
                'description' => 'Kit avec guirlande "Happy Birthday" dorée et ballons confettis transparents. Chic et lumineux.',
                'price'       => 14,
                'stock'       => 35,
                'is_active'   => true,
                'image'       => 'images/products/Golden_set.png',
            ],

            // Mariage
            [
                'category_id' => $mariage,
                'name'        => 'Bouquet de Roses Blanches',
                'slug'        => 'bouquet-roses-blanches',
                'description' => 'Magnifique bouquet de roses blanches et feuillage vert, idéal pour la mariée ou la décoration de table.',
                'price'       => 34,
                'stock'       => 15,
                'is_active'   => true,
                'image'       => 'images/products/Flower.png',
            ],
            [
                'category_id' => $mariage,
                'name'        => 'Livre d\'Or Mr & Mrs',
                'slug'        => 'livre-or-mr-mrs',
                'description' => 'Livre d\'or en bois avec inscription "Mr & Mrs" et dentelle. Format A4, 50 pages.',
                'price'       => 22,
                'stock'       => 20,
                'is_active'   => true,
                'image'       => 'images/products/Book.png',
            ],
            [
                'category_id' => $mariage,
                'name'        => 'Ballon Coeur Mariage',
                'slug'        => 'ballon-coeur-mariage',
                'description' => 'Ballon métallique en forme de coeur avec décoration "Unser Tag". Parfait pour décorer la salle.',
                'price'       => 8,
                'stock'       => 35,
                'is_active'   => true,
                'image'       => 'images/products/Baloon.png',
            ],

            // Bébé & Enfants
            [
                'category_id' => $prenatal,
                'name'        => 'Bannière Baby Shower',
                'slug'        => 'banniere-baby-shower',
                'description' => 'Bannière pastel "Baby Shower" avec étoiles et lune. Parfaite pour accueillir le nouveau-né.',
                'price'       => 8,
                'stock'       => 25,
                'is_active'   => true,
                'image'       => 'images/products/Title.jpeg',
            ],
            [
                'category_id' => $prenatal,
                'name'        => 'Kit Décoration Licorne',
                'slug'        => 'kit-decoration-licorne',
                'description' => 'Kit complet : ballons, guirlande et chapeau de fête sur le thème licorne.',
                'price'       => 14,
                'stock'       => 20,
                'is_active'   => true,
                'image'       => 'images/products/Full_set.jpeg',
            ],

            // Noël
            [
                'category_id' => $noel,
                'name'        => 'Set Serre-têtes de Noël',
                'slug'        => 'set-serre-tetes-noel',
                'description' => 'Set de 4 serre-têtes festifs sur le thème de Noël : lutin, houx, sapin et bonnet. Idéal pour animer vos soirées de fête.',
                'price'       => 12,
                'stock'       => 40,
                'is_active'   => true,
                'image'       => 'images/products/Band_Set.jpeg',
            ],
            [
                'category_id' => $noel,
                'name'        => 'Bonnet du Père Noël',
                'slug'        => 'bonnet-pere-noel',
                'description' => 'Bonnet rouge brodé "Joyeux Noël" avec pompon blanc. Taille adulte.',
                'price'       => 8,
                'stock'       => 60,
                'is_active'   => true,
                'image'       => 'images/products/Hat.jpeg',
            ],
            [
                'category_id' => $noel,
                'name'        => 'Sapin de Noël Décoré',
                'slug'        => 'sapin-noel-decore',
                'description' => 'Sapin artificiel 180cm entièrement décoré avec guirlandes LED, boules et étoile au sommet.',
                'price'       => 89,
                'stock'       => 10,
                'is_active'   => true,
                'image'       => 'images/products/Tree.jpeg',
            ],

            // Halloween
            [
                'category_id' => $halloween,
                'name'        => 'Lunettes Citrouille Halloween',
                'slug'        => 'lunettes-citrouille-halloween',
                'description' => 'Lunettes originales en forme de citrouille pour Halloween. Idéales pour les déguisements et soirées.',
                'price'       => 5,
                'stock'       => 40,
                'is_active'   => true,
                'image'       => 'images/products/Glass_set.png',
            ],
            [
                'category_id' => $halloween,
                'name'        => 'Set de 4 Lunettes Halloween',
                'slug'        => 'set-4-lunettes-halloween',
                'description' => 'Set de 4 paires de lunettes thème Halloween : citrouilles, toiles d\'araignée et lunettes ensanglantées.',
                'price'       => 14,
                'stock'       => 25,
                'is_active'   => true,
                'image'       => 'images/products/Glasses_Set.png',
            ],

    
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
