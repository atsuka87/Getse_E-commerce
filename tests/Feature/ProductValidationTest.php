<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductValidationTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;
    private Category $category;
    private Brand $brand;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $this->category = Category::create([
            'name' => 'Elektronik',
            'slug' => 'elektronik',
            'is_active' => true,
        ]);

        $this->brand = Brand::create([
            'name' => 'LG',
            'slug' => 'lg',
            'is_active' => true,
        ]);
    }

    public function test_cannot_create_product_with_duplicate_name(): void
    {
        // Create an existing product
        Product::create([
            'name' => 'Kulkas 2 Pintu LG GNB 195',
            'slug' => 'kulkas-2-pintu-lg-gnb-195',
            'category_id' => $this->category->id,
            'brand_id' => $this->brand->id,
            'price' => 5000000,
            'stock' => 5,
            'status' => 'active',
            'condition' => 'new',
        ]);

        // Attempt to create another product with the exact same name
        $response = $this
            ->actingAs($this->admin)
            ->post(route('admin.products.store'), [
                'name' => 'Kulkas 2 Pintu LG GNB 195',
                'category_id' => $this->category->id,
                'brand_id' => $this->brand->id,
                'price' => 4500000,
                'stock' => 10,
                'status' => 'active',
                'condition' => 'new',
            ]);

        $response->assertSessionHasErrors(['name']);
        $this->assertEquals(1, Product::count());
    }

    public function test_cannot_create_product_with_duplicate_sku(): void
    {
        // Create an existing product with an SKU
        Product::create([
            'name' => 'Kulkas 2 Pintu LG GNB 195',
            'slug' => 'kulkas-2-pintu-lg-gnb-195',
            'category_id' => $this->category->id,
            'brand_id' => $this->brand->id,
            'price' => 5000000,
            'stock' => 5,
            'sku' => 'LG-KULKAS-GNB195',
            'status' => 'active',
            'condition' => 'new',
        ]);

        // Attempt to create another product with a different name but the same SKU
        $response = $this
            ->actingAs($this->admin)
            ->post(route('admin.products.store'), [
                'name' => 'Kulkas Baru LG',
                'category_id' => $this->category->id,
                'brand_id' => $this->brand->id,
                'price' => 4500000,
                'stock' => 10,
                'sku' => 'LG-KULKAS-GNB195',
                'status' => 'active',
                'condition' => 'new',
            ]);

        $response->assertSessionHasErrors(['sku']);
        $this->assertEquals(1, Product::count());
    }

    public function test_cannot_update_product_to_duplicate_name_of_another_product(): void
    {
        // Create product 1
        $product1 = Product::create([
            'name' => 'Kulkas 2 Pintu LG GNB 195',
            'slug' => 'kulkas-2-pintu-lg-gnb-195',
            'category_id' => $this->category->id,
            'brand_id' => $this->brand->id,
            'price' => 5000000,
            'stock' => 5,
            'status' => 'active',
            'condition' => 'new',
        ]);

        // Create product 2
        $product2 = Product::create([
            'name' => 'TV LED LG 32 Inch',
            'slug' => 'tv-led-lg-32-inch',
            'category_id' => $this->category->id,
            'brand_id' => $this->brand->id,
            'price' => 3000000,
            'stock' => 3,
            'status' => 'active',
            'condition' => 'new',
        ]);

        // Attempt to update product 2 to have product 1's name
        $response = $this
            ->actingAs($this->admin)
            ->put(route('admin.products.update', $product2), [
                'name' => 'Kulkas 2 Pintu LG GNB 195',
                'category_id' => $this->category->id,
                'brand_id' => $this->brand->id,
                'price' => 3200000,
                'stock' => 3,
                'status' => 'active',
                'condition' => 'new',
            ]);

        $response->assertSessionHasErrors(['name']);
        $product2->refresh();
        $this->assertEquals('TV LED LG 32 Inch', $product2->name);
    }

    public function test_can_update_product_retaining_its_own_name(): void
    {
        // Create product
        $product = Product::create([
            'name' => 'Kulkas 2 Pintu LG GNB 195',
            'slug' => 'kulkas-2-pintu-lg-gnb-195',
            'category_id' => $this->category->id,
            'brand_id' => $this->brand->id,
            'price' => 5000000,
            'stock' => 5,
            'status' => 'active',
            'condition' => 'new',
        ]);

        // Update other attributes but keep the same name
        $response = $this
            ->actingAs($this->admin)
            ->put(route('admin.products.update', $product), [
                'name' => 'Kulkas 2 Pintu LG GNB 195',
                'category_id' => $this->category->id,
                'brand_id' => $this->brand->id,
                'price' => 5200000, // modified price
                'stock' => 6,       // modified stock
                'status' => 'active',
                'condition' => 'new',
            ]);

        $response->assertSessionHasNoErrors();
        $product->refresh();
        $this->assertEquals(5200000, (int)$product->price);
        $this->assertEquals(6, $product->stock);
    }
}
