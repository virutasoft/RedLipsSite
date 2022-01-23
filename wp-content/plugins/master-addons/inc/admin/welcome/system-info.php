<?php
$jltma_valid    = '<span class="jltma-valid"><i class="dashicons-before dashicons-yes"></i></span>';
$jltma_invalid  = '<span class="jltma-invalid"><i class="dashicons-before dashicons-no-alt"></i></span>';
?>
<div class="jltma-master-addons-tab-panel" id="jltma-master-addons-system-info" style="display: none;">

    <div class="jltma-master-addons-features jltma-system-info">

        <div class="jltma-tab-dashboard-wrapper is-flex">
            <!-- Start of WordPress Environment -->
            <div class="jltma-api-settings-element jltma-half">
                <h4><?php echo esc_html__('WordPress Environment', JLTMA_TD); ?></h4>
                <div class="jltma-api-element-inner">
                    <div class="jltma-api-forms">

                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td><?php _e('Home URL', JLTMA_TD); ?>:</td>
                                    <td><?php form_option('home'); ?></td>
                                </tr>
                                <tr>
                                    <td><?php _e('Site URL', JLTMA_TD); ?>:</td>
                                    <td><?php form_option('siteurl'); ?></td>
                                </tr>
                                <tr>
                                    <td><?php _e('WP Version', JLTMA_TD); ?>:</td>
                                    <td><?php
                                        global $wp_version;
                                        if (version_compare($wp_version, '4.0') >= 0) {
                                            echo $jltma_valid;
                                            echo '<span>' . bloginfo('version') . '</span>';
                                        } else {
                                            echo '<span>' . get_bloginfo('version') . ' (Min: 4.0 Recommended)</span>';
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <td><?php _e('WP Multisite', JLTMA_TD); ?>:</td>
                                    <td><?php
                                        if (is_multisite()) {
                                            echo $jltma_valid . 'Enabled';
                                        } else {
                                            echo $jltma_invalid . 'Disabled';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('WP Memory Limit', JLTMA_TD); ?>:</td>
                                    <td><?php
                                        $jltma_memory_limit       = ini_get('memory_limit');
                                        if (intval($jltma_memory_limit) < '256') {
                                            echo $jltma_invalid;
                                            echo sprintf(__('<span>%s - (Min: 256M Recommended).</span> <a href="%2$s" target="_blank">Increasing WP Memory Limit</a>', JLTMA_TD), $jltma_time_limit, 'https://master-addons.com/elementor-editor-not-loading-issue/');
                                        } else {
                                            echo $jltma_valid;
                                            echo '<span>' . $jltma_memory_limit . '</span>';
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <td><?php _e('WP Path', JLTMA_TD); ?>:</td>
                                    <td><?php echo ABSPATH; ?></td>
                                </tr>

                                <tr>
                                    <td><?php _e('Wriable Uploads Folder', JLTMA_TD); ?>:</td>
                                    <td><?php
                                        $jltma_uploads            = wp_upload_dir();
                                        $jltma_upload_path        = $jltma_uploads['basedir'];
                                        if (is_writable($jltma_upload_path)) {
                                            echo $jltma_valid . 'Writable';
                                        } else {
                                            echo $jltma_invalid . 'Not Writable';
                                        }
                                        ?></td>
                                </tr>

                                <tr>
                                    <td><?php _e('WP Debug Mode', JLTMA_TD); ?>:</td>
                                    <td>
                                        <?php
                                        if (defined('WP_DEBUG') && WP_DEBUG) {
                                            echo $jltma_valid . 'Enabled';
                                        } else {
                                            echo $jltma_invalid . 'Disabled';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Language', JLTMA_TD); ?>:</td>
                                    <td><?php echo get_locale() ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div><!-- /.api-element-inner -->
            </div><!-- /.api-settings-element -->
            <!-- End of WordPress Environment -->



            <!-- Start of Server Information -->
            <div class="jltma-api-settings-element jltma-half">
                <h4><?php echo esc_html__('Server Requirements', JLTMA_TD); ?></h4>
                <div class="jltma-api-element-inner">
                    <div class="jltma-api-forms">

                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td><?php _e('Server Info', JLTMA_TD); ?>:</td>
                                    <td><?php echo esc_html($_SERVER['SERVER_SOFTWARE']); ?></td>
                                </tr>
                                <tr>
                                    <td><?php _e('PHP Version', JLTMA_TD); ?>:</td>
                                    <td><?php
                                        // Check if phpversion function exists
                                        if (function_exists('phpversion')) {
                                            $php_version = phpversion();
                                            if (version_compare($php_version, '5.6.0', '<')) {
                                                echo $jltma_invalid;
                                                echo '<span>' . esc_html($php_version) . '(Min: 5.6 Recommended)</span>';
                                            } else {
                                                echo $jltma_valid;
                                                echo '<span">' . esc_html($php_version) . '</span>';
                                            }
                                        } ?></td>
                                </tr>
                                <?php if (function_exists('ini_get')) : ?>
                                    <tr>
                                        <td><?php _e('PHP Memory Limit', JLTMA_TD); ?>:</td>
                                        <td><?php
                                            $jltma_memory_limit = ini_get('memory_limit');
                                            if (intval($jltma_memory_limit) < '256') {
                                                echo $jltma_invalid;
                                                echo '<span>' . esc_html($jltma_memory_limit) . ' (Min: 256M Recommended)</span>';
                                            } else {
                                                echo $jltma_valid;
                                                echo '<span>' . esc_html($jltma_memory_limit) . '</span>';
                                            }
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php _e('PHP Post Max Size', JLTMA_TD); ?>:</td>
                                        <td><?php
                                            $jltma_post_max_size = ini_get('post_max_size');
                                            if (intval($jltma_post_max_size) < 32) {
                                                echo $jltma_invalid;
                                                echo '<span>' . esc_html($jltma_post_max_size) . ' (Min: 32M Recommended)</span>';
                                            } else {
                                                echo $jltma_valid;
                                                echo '<span>' . esc_html($jltma_post_max_size) . '</span>';
                                            }
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php _e('PHP Time Limit', JLTMA_TD); ?>:</td>
                                        <td>
                                            <?php
                                            $jltma_time_limit = ini_get('max_execution_time');
                                            if (intval($jltma_time_limit) < 120 && $jltma_time_limit != 0) {
                                                echo $jltma_invalid;
                                                echo sprintf(__('<span> %s - (Min: Recommended 300).</span><a href="%2$s" target="_blank">Increasing WP Time Limit</a>', JLTMA_TD), $jltma_time_limit, 'https://master-addons.com/elementor-editor-not-loading-issue/');
                                            } else {
                                                echo $jltma_valid;
                                                echo '<span>' . esc_html($jltma_time_limit) . '</span>';
                                            }
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <td><?php _e('PHP Max Input Vars', JLTMA_TD); ?>:</td>
                                        <td><?php
                                            $jltma_max_input_vars = ini_get('max_input_vars');
                                            if (intval($jltma_max_input_vars) < 1000) {
                                                echo $jltma_invalid;
                                                echo '<span>' . esc_html($jltma_max_input_vars) . ' (Min: 1000 Recommended)</span>';
                                            } else {
                                                echo $jltma_valid;
                                                echo '<span>' . $jltma_max_input_vars . '</span>';
                                            }
                                            ?></td>
                                    </tr>
                                <?php endif; ?>
                                <tr>
                                    <td><?php _e('MySQL Version', JLTMA_TD); ?>:</td>
                                    <td>
                                        <?php
                                        /** @global wpdb $wpdb */
                                        global $wpdb;
                                        $jltma_mysql_version =  $wpdb->db_version();
                                        if ($jltma_mysql_version < 5.3) {
                                            echo $jltma_invalid;
                                            echo '<span>' . esc_html($jltma_mysql_version) . '(Min: 5.3 Recommended)</span>';
                                        } else {
                                            echo $jltma_valid;
                                            echo '<span>' . $jltma_mysql_version . '</span>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php _e('Max Upload Size', JLTMA_TD); ?>:</td>
                                    <td><?php
                                        $jltma_max_upload_size = size_format(wp_max_upload_size());
                                        if ($jltma_max_upload_size < 20) {
                                            echo $jltma_invalid;
                                            echo '<span>' . esc_html($jltma_max_upload_size) . '(Min: 20 Recommended)</span>';
                                        } else {
                                            echo $jltma_valid;
                                            echo '<span>' . $jltma_max_upload_size . '</span>';
                                        }
                                        ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div><!-- /.api-element-inner -->
            </div><!-- /.api-settings-element -->
            <!-- End of Server Information -->




            <!-- Start of PHP Extensions -->
            <div class="jltma-api-settings-element jltma-half">
                <h4><?php echo esc_html__('PHP Extensions', JLTMA_TD); ?></h4>
                <div class="jltma-api-element-inner">
                    <div class="jltma-api-forms">

                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td><?php _e('cURL', JLTMA_TD); ?>:</td>
                                    <td><?php
                                        if (!function_exists('curl_init')) {
                                            echo $jltma_invalid;
                                            echo '<span>' . _e('Not Installed', JLTMA_TD);
                                        } else {
                                            echo $jltma_valid;
                                            echo '<span>' . _e('Supported', JLTMA_TD);
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <td><?php _e('fsockopen', JLTMA_TD); ?>:</td>
                                    <td><?php
                                        if (!function_exists('fsockopen')) {
                                            echo $jltma_invalid;
                                            echo '<span>' . _e('Not Installed', JLTMA_TD);
                                        } else {
                                            echo $jltma_valid;
                                            echo '<span>' . _e('Supported', JLTMA_TD);
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <td><?php _e('SOAP Client', JLTMA_TD); ?>:</td>
                                    <td><?php
                                        if (!class_exists('SoapClient')) {
                                            echo $jltma_invalid;
                                            echo '<span>' . _e('Not Installed', JLTMA_TD);
                                        } else {
                                            echo $jltma_valid;
                                            echo '<span>' . _e('Supported', JLTMA_TD);
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <td><?php _e('Suhosin', JLTMA_TD); ?>:</td>
                                    <td><?php
                                        if (!extension_loaded('suhosin')) {
                                            echo $jltma_invalid;
                                            echo '<span>' . _e('Not Installed', JLTMA_TD);
                                        } else {
                                            echo $jltma_valid;
                                            echo '<span>' . _e('Supported', JLTMA_TD);
                                        }
                                        ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div><!-- /.api-element-inner -->
            </div><!-- /.api-settings-element -->
            <!-- End of PHP Extensions -->

            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="icon-copy" viewBox="0 0 32 32">
                    <path d="M20 8v-8h-14l-6 6v18h12v8h20v-24h-12zM6 2.828v3.172h-3.172l3.172-3.172zM2 22v-14h6v-6h10v6l-6 6v8h-10zM18 10.828v3.172h-3.172l3.172-3.172zM30 30h-16v-14h6v-6h10v20z"></path>
                </symbol>
            </svg>


            <!-- Start of Active Plugins -->
            <div class="jltma-api-settings-element jltma-half jltma-copy-section">
                <h4><?php echo esc_html__('Active Plugins', JLTMA_TD); ?> (<?php echo count((array) get_option('active_plugins')); ?>)</h4>

                <button class="jltma-copy-button" data-text="COPY" data-text-copied="COPIED">
                    <svg class="icon icon-copy">
                        <use xlink:href="#icon-copy"></use>
                    </svg>
                    <span>COPY</span>
                </button>

                <div class="jltma-api-element-inner">
                    <div class="jltma-api-forms">

                        <table class="table table-striped">
                            <tbody>
                                <?php

                                $active_plugins = (array) get_option('active_plugins', array());

                                if (is_multisite()) {
                                    $network_activated_plugins = array_keys(get_site_option('active_sitewide_plugins', array()));
                                    $active_plugins            = array_merge($active_plugins, $network_activated_plugins);
                                }

                                foreach ($active_plugins as $plugin) {

                                    $plugin_data    = @get_plugin_data(WP_PLUGIN_DIR . '/' . $plugin);
                                    $dirname        = dirname($plugin);
                                    $version_string = '';
                                    $network_string = '';

                                    if (!empty($plugin_data['Name'])) {

                                        // link the plugin name to the plugin url if available
                                        $plugin_name = esc_html($plugin_data['Name']);

                                        if ('Master Addons for Elementor' === $plugin_name) {
                                            $plugin_name = JLTMA;
                                            $author = JLTMA_PLUGIN_AUTHOR;
                                            if ('Jewel Theme' !== $author) {
                                                $plugin_data['Author'] = JLTMA_PLUGIN_AUTHOR;
                                            }
                                        } elseif ('Master Addons for Elementor Pro' === $plugin_name) {
                                            $plugin_name = JLTMA;
                                            $author = JLTMA_PLUGIN_AUTHOR;
                                            if ('Jewel Theme' !== $author) {
                                                $plugin_data['Author'] = JLTMA_PLUGIN_AUTHOR;
                                            }
                                        }

                                        if (!empty($plugin_data['PluginURI'])) {
                                            $plugin_name = '<a href="' . esc_url($plugin_data['PluginURI']) . '" title="' . esc_attr__('Visit plugin homepage', JLTMA_TD) . '" target="_blank">' . $plugin_name . '</a>';
                                        }
                                ?>
                                        <tr>
                                            <td><?php echo $plugin_name; ?></td>
                                            <td><?php echo sprintf(_x('by %s', 'by author', JLTMA_TD), $plugin_data['Author']) . ' &ndash; v' . esc_html($plugin_data['Version']) . $version_string . $network_string; ?></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div><!-- /.api-element-inner -->
            </div><!-- /.api-settings-element -->
            <!-- End of Active Plugins -->

        </div>

    </div><!-- /.master_addons_feature -->

</div>
