<?php namespace ConsulConfigManager\Domain\ViewModels;

use Closure;
use Illuminate\Console\Command;
use ConsulConfigManager\Domain\Interfaces\ViewModel;

/**
 * Class CLIViewModel
 *
 * @package App\Domain\ViewModels
 */
class CLIViewModel implements ViewModel {

    /**
     * Model handler instance
     * @var Closure
     */
    private Closure $handler;

    /**
     * CLIViewModel Constructor.
     *
     * @param Closure $handler
     */
    public function __construct(Closure $handler) {
        $this->handler = $handler;
    }

    /**
     * Handle command
     * @param Command $command
     *
     * @return mixed
     */
    public function handle(Command $command): mixed {
        return $this->handler->call($command, $command);
    }

}
