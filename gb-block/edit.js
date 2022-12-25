import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, SelectControl, TextControl } from '@wordpress/components';
import ServerSideRender from '@wordpress/server-side-render';

/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps();

	return (
		<>
		<InspectorControls>
        <PanelBody title={__( 'Settings' )}>
				<SelectControl
					label="Language"
					value={ attributes.displayLanguage }
					options={ [
							{ label: 'Nepali', value: 'np' },
							{ label: 'English', value: 'en' },
					] }
					onChange={(newval) => setAttributes( {displayLanguage: newval})}
        />
				<TextControl
					label="Date Format"
					value={ attributes.displayFormat }
					onChange={(newval) => setAttributes( {displayFormat: newval})}
				/>
        </PanelBody>
      </InspectorControls>

			<div { ...blockProps }>
				<ServerSideRender block="date-today-nepali/date" attributes={ attributes } className="render-wrapper" />
			</div>

		</>
	);
}
