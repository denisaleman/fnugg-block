/**
 * A very simple autocomplete component
 *
 * This is to replace the OOTB Gutenberg Autocomplete component because it is
 * currently broken as of v4.5.1.
 *
 * See Github issue: https://github.com/WordPress/gutenberg/issues/10542
 *
 * Note: The options array should be an array of objects containing labels and values; i.e.:
 *   [
 *     { value: 'first', label: 'First' },
 *     { value: 'second', label: 'Second' }
 *   ]
 */
 import { __ } from '@wordpress/i18n';
 import './autocomplete.scss';

function DekodeAutocomplete({
    label,
    id,
    value,
    placeholder,
    textdomain = 'decode-autocomplete',
    onChange,
    options = []
}) {

    // Construct a unique ID for this block.
    const blockId = `my-autocomplete-${id}`;

    // Function to handle the onChange event.
    const onChangeValue = ( event ) => {
        onChange( event.target.value );
    };

    return (
        <div className="dekode-autocomplete">
            { /* Label for the block. */}
            <label className="dekode-autocomplete__label" for={blockId}>
                {__( label, textdomain )}
            </label>

            { /* Input field. */}
            <input
                className="dekode-autocomplete__input"
                list={blockId}
                value={value}
                onChange={onChangeValue}
                placeholder={__( placeholder, textdomain )}
            />

            { /* List of all of the autocomplete options. */}
            <datalist className="dekode-autocomplete__options-list" id={blockId}>
                {options.map( ( option, index ) =>
                    <option value={option.value} label={option.label} />
                )}
            </datalist>
        </div>
    );
};

export default DekodeAutocomplete;
