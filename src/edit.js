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

function FormatMessage() {
	return (
		<table className="example">
			<tbody>
				<tr>
					<td>
						<strong>Format</strong>
					</td>
					<td>
						<strong>Example</strong>
					</td>
				</tr>

				<tr>
					<td>
						<code>d F Y</code>
					</td>
					<td>१८ जेठ २०७७</td>
				</tr>
				<tr>
					<td>
						<code>F d, Y</code>
					</td>
					<td>जेठ १८, २०७७</td>
				</tr>
				<tr>
					<td>
						<code>Y F d</code>
					</td>
					<td>२०७७ जेठ १८</td>
				</tr>
				<tr>
					<td>
						<code>l, d F Y</code>
					</td>
					<td>आइतबार, १८ जेठ २०७७</td>
				</tr>
				<tr>
					<td>
						<code>d.m.y</code>
					</td>
					<td>१८.०२.७७</td>
				</tr>
				<tr>
					<td>
						<code>Y.m.d</code>
					</td>
					<td>२०७७.०२.१८</td>
				</tr>
				<tr>
					<td>
						<code>D, d F</code>
					</td>
					<td>आइत, १८ जेठ</td>
				</tr>
				<tr>
					<td>
						<code>Y F d, l</code>
					</td>
					<td>२०७७ जेठ १८, आइतबार</td>
				</tr>
			</tbody>
		</table>
	);
}

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @param  root0
 * @param  root0.attributes
 * @param  root0.setAttributes
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */
export default function Edit( { attributes, setAttributes } ) {
	const blockProps = useBlockProps();

	return (
		<>
			<InspectorControls>
				<PanelBody title={ __( 'Settings' ) }>
					<SelectControl
						label="Language"
						value={ attributes.displayLanguage }
						options={ [
							{ label: 'Nepali', value: 'np' },
							{ label: 'English', value: 'en' },
						] }
						onChange={ ( newval ) =>
							setAttributes( { displayLanguage: newval } )
						}
					/>
					<TextControl
						label="Date Format"
						value={ attributes.displayFormat }
						onChange={ ( newval ) =>
							setAttributes( { displayFormat: newval } )
						}
					/>

					<FormatMessage />
				</PanelBody>
			</InspectorControls>

			<div { ...blockProps }>
				<ServerSideRender
					block="date-today-nepali/date"
					attributes={ attributes }
					className="render-wrapper"
				/>
			</div>
		</>
	);
}
