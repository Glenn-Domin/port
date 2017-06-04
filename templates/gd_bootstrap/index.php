<?php defined('_JEXEC') or die; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <?php
      $app = JFactory::getApplication();
      $document = $app->getDocument();
      $menu = $app->getMenu();
      $active = $menu->getActive();
      
      $document->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/bootstrap.css');
      $document->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/grid_12.css');
      $document->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/nav-horizontal.css');
      $document->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template.css');
      JHtml::_('jquery.framework', false);
    ?>
    
    <jdoc:include type="head" />
  </head>

  <body class="<?php echo $active->params->get('pageclass_sfx'); ?>">
    <header>
      <div class="branding">
        <jdoc:include type="modules" name="branding" />
      </div>
      <nav>
        <jdoc:include type="modules" name="navigation" />
      </nav>
    </header>
      
      <?php if ($this->countModules('banner')) : ?>
      <section class="banner">
        <jdoc:include type="modules" name="banner" style="xhtml" />
      </section>
      <?php endif; ?>
      
      <!--<section id="content" class="content-main to-animate">-->
      <section class="content-main">
        <div class="content">
          <?php if ($this->countModules('precomponent')) : ?>
            <div class="pre-component">
              <jdoc:include type="modules" name="precomponent" style="xhtml" />
            </div>
          <?php endif; ?>

          <jdoc:include type="component" />
        </div>
      </section>
    
      <footer>
        <div class="container">
          <jdoc:include type="modules" name="footer" />
        </div>
      </footer>
    
    <script type="text/javascript" async defer>
    jQuery("head").append("<link>");
    var css = jQuery("head").children(":last");
    css.attr({
          rel:  "stylesheet",
          type: "text/css",
          href: "<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/after.css"
    });
    jQuery( document ).ready(function() {
      jQuery.getScript("<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/scripts.js");
    });
    </script>
  </body>
</html>