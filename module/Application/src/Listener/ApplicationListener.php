<?php
/**
 * stockfoto-nik cms
 *  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/stockfoto-nik
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @version    1.0.0
 * @since      1.0.0
 */

namespace Application\Listener;

use Application\ValueObject\Data;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventInterface;
use Zend\Mvc\MvcEvent;
use Zend\View\Model\ViewModel;
use Locale;

/**
 * Application listener
 * 
 * @package Application
 * @subpackage Application\Listener
 */
class ApplicationListener extends AbstractListenerAggregate
{
    /**
     * {@inheritDoc}
     */
    public function attach(EventManagerInterface $events, $priority = -100)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_ROUTE, 
            [$this, 'setupLocalization'],
            $priority
        );
        // Listen to the "render" event and add layout segments to the view
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_RENDER,
            [$this, 'addLayoutSegments'],
            $priority
        );
    }
    
    /**
     * Listen to the "route" event and setup the localization
     *
     * @param  MvcEvent $e
     * @return void
     */
    public function setupLocalization(EventInterface $e)
    {
        $routeMatch = $e->getRouteMatch();
        $locale = $routeMatch->getParam('locale');
        $translator = $e->getApplication()
            ->getServiceManager()->get('MvcTranslator');
        $translator->setFallbackLocale(Data::MY_FALLBACK_LOCALE);
        if (!empty($locale) && in_array ($locale, Data::MY_LOCALES)) {
            Locale::setDefault($locale);
            $translator->setLocale($locale);
        } else {
            Locale::setDefault(Data::MY_FALLBACK_LOCALE);
            $translator->setLocale(Data::MY_FALLBACK_LOCALE);
        }
    }

    /**
     * Add layout segments to the view
     *
     * @param  MvcEvent $e
     * @return void
     */
    public function addLayoutSegments(EventInterface $e)
    {
        /** @var $viewModel ViewModel */
        $viewModel = $e->getViewModel();
        // skip if current ViewModel is not of expected type
        if ('Zend\View\Model\ViewModel' != get_class($viewModel)) {
            return;
        }
        /** @var AggregateResolver $resolver */
        $resolver = $e->getApplication()->getServiceManager()
            ->get('ViewResolver');
        $segmentsConfig = APPLICATION_MODULE_ROOT
            . '/config/view_manager/layout_segments.config.php';
        $segments = include $segmentsConfig;
        // loop through layout segments
        foreach (array_keys($segments) as $segmentPath) {
            // skip if layout segment does not exist
            if (!$resolver->resolve($segmentPath)) {
                continue;
            }
            // add the segment to layout
            $viewSegment = new ViewModel();
            $viewSegment->setTemplate($segmentPath);
            $parts = explode('/', $segmentPath);
            $segment = end($parts);
            $viewModel->addChild($viewSegment, $segment);
        }
    }
}