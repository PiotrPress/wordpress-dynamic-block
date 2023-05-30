import { registerBlockType } from '@wordpress/blocks';
import { useBlockProps } from '@wordpress/block-editor';
import { SelectControl } from '@wordpress/components';

registerBlockType( 'piotrpress/dynamic-block', {
    edit: function ( { attributes, setAttributes } ) {
        const blockProps = useBlockProps();

        return (
            <div { ...blockProps }>
                <SelectControl
                    label="Dynamic Block"
                    value={ attributes.callback }
                    options={ attributes.callbacks }
                    onChange={ ( value ) => setAttributes( { callback: value } ) }
                    __nextHasNoMarginBottom
                />
            </div>
        );
    }
} );