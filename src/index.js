import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps, InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { __ } from '@wordpress/i18n';
import ServerSideRender from '@wordpress/server-side-render';

registerBlockType( 'piotrpress/dynamic-block', {
    edit: ( { attributes, setAttributes } ) => {
        return (
            <div { ...useBlockProps() }>
                <InspectorControls>
                    <PanelBody>
                        <SelectControl
                            label={ __( 'Render', 'piotrpress-dynamic-block' ) }
                            value={ attributes.callback }
                            options={ attributes.callbacks }
                            onChange={ ( value ) => setAttributes( { callback: value } ) }
                            __nextHasNoMarginBottom
                        />
                    </PanelBody>
                </InspectorControls>
                <ServerSideRender
                    block='piotrpress/dynamic-block'
                    attributes={ attributes }
                />
            </div>
        );
    }
} );