<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
            <!-- BEGIN: 960 grid structure -->
        <div class="container_100 content">
        <div class="container_12">
                
            <!-- BEGIN: pre content -->
            <div id="pre-content" class="grid_12">
                <div id="mod-precontent"><jdoc:include type="modules" name="precontent" /></div>
            </div>
            <div class="clear"></div>
            <!-- END: pre content -->

            <!-- BEGIN: content area -->
            <div id="if-content">
				
				<? if($has_left){?>
                <div class="grid_3 grid_small_12" id="left">
                    <div id="left-inner">
                        <div id="mod-left"><jdoc:include type="modules" name="left" style="xhtml" /></div>
                    </div>
                </div>
				<? } // End left ?>
                <div class="grid_<? echo $center_width; ?>" id="component">

                    <!-- BEGIN: system messages -->
                    <?php if (count($app->getMessageQueue())): ?>
                    <div id="message">
                        <jdoc:include type="message" />
                    </div>
                    <?php endif; ?>
                    <!-- END: system messages -->
    
                    <div id="content-inner">
    
                        <div id="pre-component">
                            <div id="mod-precomponent"><jdoc:include type="modules" name="precomponent" style="xhtml" /></div>
                        </div>
    
                        <jdoc:include type="component" /><?php // We assume there will always be content ... ( style=".." -> table, horz, rounded, outline, xhtml - outputs module title, tec..)?>
    
                        <div id="post-component">
                            <div id="mod-postcomponent"><jdoc:include type="modules" name="postcomponent" style="xhtml" /></div>
                        </div>
                    </div>
                </div>
				<? if($has_right){?>
                <div class="grid_3 grid_small_12" id="right">
                    <div id="right-inner">
                        <div id="mod-right"><jdoc:include type="modules" name="right" style="xhtml" /></div>
                    </div>
                </div>
				<? } // end right ?>
                <div class="clear"></div>
                <!-- END: three column -->
            </div>
            <!-- END: content area -->

            <!-- BEGIN: post content -->
            <div id="post-content" class="grid_12">
                <div id="mod-postcontent"><jdoc:include type="modules" name="postcontent" /></div>
            </div>
            <!-- END: post content -->
            
            <!-- END: 960 grid structure -->
            </div>
            </div>