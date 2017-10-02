<?php

namespace App\Http\Middleware;

use Closure;

class SMMenu
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  int $iModule can be:
     *          \Config::get('scsys.MODULES.MRP')
     *          \Config::get('scsys.MODULES.MMS')
     *          \Config::get('scsys.MODULES.QMS')
     *          \Config::get('scsys.MODULES.WMS')
     *          \Config::get('scsys.MODULES.TMS')
     * @return mixed
     */
    public function handle($request, Closure $next, $iModule)
    {
      switch ($iModule) {
        case \Config::get('scsys.MODULES.MRP'):
          \Menu::make('sMenu', function($menu) {
              $menu->add('Home', ['route' => 'mms.home']);
              $menu->add(trans('mrp.MRP'), '')->nickname(trans('mrp.MRP'));
              $menu->get(trans('mrp.MRP'))->add(trans('mrp.MRP_COMPANIES'), ['route' => 'mrp.companies.index']);
              $menu->get(trans('mrp.MRP'))->add(trans('mrp.BRANCHES'), ['route' => 'mrp.branches.index']);
              $menu->get(trans('mrp.MRP'))->add(trans('mrp.ACG_YEAR_PER'), ['route' => 'mrp.years.index']);
              $menu->get(trans('mrp.MRP'))->add(trans('mrp.BPS'), ['route' => 'mrp.bps.index']);
              $menu->add(trans('mrp.CATALOGUES'), '')->nickname(trans('mrp.CATALOGUES'));
              $menu->get(trans('mrp.CATALOGUES'))->add(trans('wms.UNITS'), ['route' => 'wms.units.index']);
          });

          break;

        case \Config::get('scsys.MODULES.MMS'):
          \Menu::make('sMenu', function($menu) {
              $menu->add(' ');
              $menu->add('Home', ['route' => 'mms.home']);
              $menu->add('About',    'about');
              $menu->add('Services', 'services');
              $menu->add('Contact',  'contact');
              $menu->add(trans('wms.REPORTS'), 'what-we-do');
          });
          break;

        case \Config::get('scsys.MODULES.QMS'):
          \Menu::make('sMenu', function($menu) {
              $menu->add(' ');
              $menu->add('Home', ['route' => 'qms.home']);
              $menu->add('About',    'about');
              $menu->add('Services', 'services');
              $menu->add('Contact',  'contact');
              $menu->add(trans('wms.REPORTS'), 'what-we-do');

          });
          break;

        case \Config::get('scsys.MODULES.WMS'):
          \Menu::make('sMenu', function($menu) {
              $menu->add(' ');
              $menu->add(trans('userinterface.HOME'), ['route' => 'wms.home']);
              $menu->add(trans('wms.CONFIG'), 'what-we-do')->nickname(trans('wms.CONFIG'));
              $menu->get(trans('wms.CONFIG'))->add(trans('wms.CONFIG'), 'what-we-do');
              $menu->get(trans('wms.CONFIG'))->add(trans('wms.CONFIG'), 'what-we-do');
              $menu->add(trans('wms.CATALOGUES'), 'what-we-do')->nickname(trans('wms.CATALOGUES'));
              $menu->get(trans('wms.CATALOGUES'))->add(trans('wms.WAREHOUSES'), ['route' => 'wms.whs.index']);
              $menu->get(trans('wms.CATALOGUES'))->add(trans('wms.LOCATIONS'), ['route' => 'wms.locs.index']);
              $menu->get(trans('wms.CATALOGUES'))->add(trans('wms.PALLETS'), 'what-we-do');
              $menu->get(trans('wms.CATALOGUES'))->add(trans('wms.LOTS'), 'what-we-do');
              $menu->get(trans('wms.CATALOGUES'))->add(trans('wms.BAR_CODES'), 'what-we-do');
              $menu->add(trans('wms.ITEMS'), 'what-we-do')->nickname(trans('wms.ITEMS'));
              $menu->get(trans('wms.ITEMS'))->add(trans('wms.MATERIALS'), 'what-we-do');
              $menu->get(trans('wms.ITEMS'))->add(trans('wms.PRODUCTS'), 'what-we-do');
              $menu->get(trans('wms.ITEMS'))->add(trans('wms.GENDERS'), 'what-we-do');
              $menu->get(trans('wms.ITEMS'))->add(trans('wms.GROUPS'), ['route' => 'wms.groups.index']);
              $menu->get(trans('wms.ITEMS'))->add(trans('wms.FAMILIES'), ['route' => 'wms.families.index']);
              $menu->get(trans('wms.ITEMS'))->add(trans('wms.UNITS'), ['route' => 'wms.units.index']);
              $menu->get(trans('wms.ITEMS'))->add(trans('wms.CONVERTIONS'), 'what-we-do');
              $menu->add(trans('wms.INVENTORY'), 'what-we-do');
              $menu->add(trans('wms.REPORTS'), 'what-we-do');

          });
          break;

        case \Config::get('scsys.MODULES.TMS'):
          \Menu::make('sMenu', function($menu) {
              $menu->add(' ');
              $menu->add('Home', ['route' => 'tms.home']);
              $menu->add('About',    'about');
              $menu->add('Services', 'services');
              $menu->add('Contact',  'contact');
              $menu->add(trans('wms.REPORTS'), 'what-we-do');

          });
          break;

        default:
          # code...
          break;
      }

        return $next($request);
    }
}
