<?php namespace ConsulConfigManager\Domain;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use ConsulConfigManager\Domain\Interfaces\DomainServiceProviderInterface;

/**
 * Class DomainServiceProvider
 *
 * @package ConsulConfigManager\Domain
 */
abstract class DomainServiceProvider extends ServiceProvider implements DomainServiceProviderInterface {

    /**
     * @inheritDoc
     */
    public function register(): void {
        if (method_exists(ServiceProvider::class, 'register')) {
            parent::register();
        }
        $this->registerFactories();
        $this->registerRepositories();
        $this->registerInterceptors();
        $this->registerServices();
    }

    /**
     * @inheritDoc
     */
    public function boot(): void {
        if (method_exists(ServiceProvider::class, 'boot')) {
            parent::boot();
        }
        $this->registerProjectors();
        $this->registerReactors();
    }

    /**
     * Register domain specific factories
     * @return void
     */
    protected function registerFactories(): void {

    }

    /**
     * Register domain specific repositories
     * @return void
     */
    protected function registerRepositories(): void {

    }

    /**
     * Register domain specific interceptors
     * @return void
     */
    protected function registerInterceptors(): void {

    }

    /**
     * Register domain specific services
     * @return void
     */
    protected function registerServices(): void {

    }

    /**
     * Register domain specific projectors
     * @return void
     */
    protected function registerProjectors(): void {

    }

    /**
     * Register domain specific reactors
     * @return void
     */
    protected function registerReactors(): void {

    }

    /**
     * Register interceptors using provided arguments
     *
     * @param string      $needs
     * @param string      $interactor
     * @param string      $whenController
     * @param string      $httpPresenter
     * @param string|null $whenCommand
     * @param string|null $cliPresenter
     */
    protected function registerInterceptorFromParameters(string $needs, string $interactor, string $whenController, string $httpPresenter, ?string $whenCommand = null, ?string $cliPresenter = null): void {
        $this->app
            ->when($whenController)
            ->needs($needs)
            ->give(function (Application $application) use ($interactor, $httpPresenter) {
                return $application->make($interactor, [
                    'output' => $application->make($httpPresenter)
                ]);
            });

        if ($whenCommand !== null && $cliPresenter !== null) {
            $this->app
                ->when($whenCommand)
                ->needs($needs)
                ->give(function (Application $application) use ($interactor, $cliPresenter) {
                    return $application->make($interactor, [
                        'output' => $application->make($cliPresenter),
                    ]);
                });
        }
    }

}
