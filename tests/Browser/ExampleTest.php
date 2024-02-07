<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Artisan;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

class ExampleTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * A basic browser test example.
     */
    protected function setup(): void
    {
        parent::setUp();
        User::factory()->create([
            'email' => 'test@test.com',
        ]);
        Artisan::call('db:seed', ['--class' => 'ProductSeeder']);
    }

    public function testBasicExample(): void
    {
        $this->browse(function (Browser $browser) {
//            $browser->visit('/')
//                    ->with('.spcial-text', function ($text) {
//                        $text->assertSee('固定資料');
//                    });
            $browser->visit('/')
                ->click('.check_product')
                    ->waitForDialog(5)
                    ->assertDialogOpened('商品數量充足')
                    ->acceptDialog();
//            eval(\Psy\sh());
        });
    }

    public function testFillForm(){
        $this->browse(function (Browser $browser) {
            $browser->visit('/contact_us')
                ->value('[name="name"]', 'cool')
                ->select('[name="product"]' , '食物')
                ->press('送出')
                ->assertQueryStringHas('product', '食物');
//            eval(\Psy\sh());
        });
    }

    protected function driver(): RemoteWebDriver
    {
        $options = (new ChromeOptions)->addArguments(collect([
            $this->shouldStartMaximized() ? '--start-maximized' : '--window-size=1920,1080',
        ])->unless($this->hasHeadlessDisabled(), function (Collection $items) {
            return $items->merge([
                '--disable-gpu',
                '--headless',
                '--no-sandbox',
                '--disable-dev-shm-usage',
                '--disable-software-rasterizer',
            ]);
        })->all());

        return RemoteWebDriver::create(
            $_ENV['DUSK_DRIVER_URL'] ?? 'http://localhost:9515',
            DesiredCapabilities::chrome()->setCapability(
                ChromeOptions::CAPABILITY, $options
            )
        );
    }
}
