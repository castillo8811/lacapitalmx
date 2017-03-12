Module: AMP HTML

Description
===========
The module aim is to provide a simple way for creating AMP pages.
See: https://www.ampproject.org

Installation
============
- Copy the module directory in to your Drupal:
  /sites/all/modules directory as usual.
- Go to: /admin/config/services/ampproject and configure needed options.

Configuration
=============
The Admin page provide following configurations:

AMP URL SEGMENT -- The string which is going to be prepended to your normal
									 entity URLs delivering AMP version of the page.

AMP STYLE URLS  -- Style paths.

AMP VISIBILITY  -- Rules to act on specific entities/[node types].

As every site implementation is different, all the module does, is:

-- The module provides the AMP router and all needed templates/theme_hook_suggestions.
   The templates available in the module are for exemplification. You should
   build your templates and manipulate the data according to your needs.
   Initial starting point for adding your values to template is:
   hook_preprocess_ampproject_html().
-- Clean-Up unsupported attributes.


Template order:

hook_preprocess_ampproject_html_____________________________________
													     																|
hook_preprocess_ampproject_content__________________________________|
															 																|
															 																|
___ entity_view() triggering all inherited Drupal templates___|


Supporting organizations:
Dennis Publishing
