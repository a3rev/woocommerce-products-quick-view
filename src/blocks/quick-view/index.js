/**
 * WordPress dependencies
 */
import { __ } from '@wordpress/i18n';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, ToggleControl } from '@wordpress/components';
import { registerBlockType } from '@wordpress/blocks';

/**
 * Internal dependencies
 */
import './editor.scss';
import metadata from './block.json';

/**
 * Quick View Button Block
 */
registerBlockType(metadata.name, {
    edit: ({ attributes, setAttributes }) => {
        const blockProps = useBlockProps();
        const { displayType } = attributes;

        return (
            <>
                <InspectorControls>
                    <PanelBody
                        title={__('Settings', 'woocommerce-products-quick-view')}
                        initialOpen={true}
                    >
                        <ToggleControl
                            label={__('Display on Hover', 'woocommerce-products-quick-view')}
                            help={
                                displayType === 'hover'
                                    ? __('Button will appear when hovering over product image.', 'woocommerce-products-quick-view')
                                    : __('Button will appear where you put the block.', 'woocommerce-products-quick-view')
                            }
                            checked={displayType === 'hover'}
                            onChange={(isChecked) => 
                                setAttributes({ displayType: isChecked ? 'hover' : 'under' })
                            }
                        />
                    </PanelBody>
                </InspectorControls>

                <div {...blockProps}>
                    <div className="wc-quick-view-block-preview">
                        <div className="wc-quick-view-placeholder">
                            {displayType === 'hover' ? (
                                <div className="quick_view_ultimate_container">
                                    <div className="quick_view_ultimate_content">
                                        <span className="quick_view_ultimate_button quick_view_ultimate_click">
                                            {__('Quick View Button (Hover)', 'woocommerce-products-quick-view')}
                                        </span>
                                    </div>
                                </div>
                            ) : (
                                <div className="quick_view_ultimate_container_under">
                                    <div className="quick_view_ultimate_content_under">
                                        <span className="quick_view_ultimate_under_link quick_view_ultimate_click">
                                            {__('Quick View Button', 'woocommerce-products-quick-view')}
                                        </span>
                                    </div>
                                </div>
                            )}
                        </div>
                    </div>
                </div>
            </>
        );
    },
    save: () => {
        // Dynamic block - Render in PHP
        return null;
    },
});
