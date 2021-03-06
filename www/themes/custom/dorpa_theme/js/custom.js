/**
 * @file
 * Global utilities.
 *
 */

(function($, Drupal) {

  'use strict';

  Drupal.behaviors.dorpa_theme = {
    attach: function(context, settings) {
      if (settings.victims !== undefined) {
        const victims = Object.entries(settings.victims);
        for (const victim of victims) {
          const victimId = victim[0];
          const since = moment(victim[1][1], 'YYYY/MM/DD');
          const viewMode = victim[1][0];
          const days = moment().diff(since, 'days') + ' jours';
          $('#days-counter-' + victimId).html(days)
            .addClass(viewMode === 'full' ? 'text-danger' : 'text-white')
            .css('font-weight', 'bold')
            .css('font-size', '1.5rem');
        }
      }
    }
  };

})(jQuery, Drupal);
