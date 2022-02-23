/**
 * Resort view component
 *
 */
 import { useBlockProps } from '@wordpress/block-editor';
 import { __ } from '@wordpress/i18n';
 import './autocomplete.scss';

function Resort({
    data = [],
    textdomain = 'decode-resort'
}) {

    const formatDate = ( dateStr ) => {
        let d = new Date( dateStr );
        return ( '0' + d.getDate() ).slice( -2 ) + '-' + ( '0' + ( d.getMonth() + 1 ) ).slice( -2 ) + '-' +
            d.getFullYear() + ' ' + ( '0' + d.getHours() ).slice( -2 ) + ':' + ( '0' + d.getMinutes() ).slice( -2 );
    };

    const formatTemperature = ( degCelcius ) => {
        return degCelcius + '°C';
    };

    const destructureResortData = ( resortData ) => {
        let data = {};
        data.name        = resortData.name;
        data.image       = resortData?.images?.image_1_1_l;
        data.condDesc    = resortData?.conditions?.combined?.top?.condition_description;
        data.lastUpdated = resortData?.last_updated;
        data.temperature = resortData?.conditions?.combined?.top?.temperature?.value;

        return data;
    };

    if ( ! data ) {
        return '';
    }

    let resort = destructureResortData( data );

    return ( <article {...useBlockProps.save()}>
        <header className="fnugg-header">
            {resort.name}
        </header>
        <main className="fnugg-resort-image">
            <img src={resort.image} />
            <div className="fnugg-resort-image__desc">
                <div className="">{resort.condDesc}</div>
                <div className="">{__( 'Opdaterd', textdomain ) + ': ' + formatDate( resort.lastUpdated )}</div>
            </div>
        </main>
        <footer className="fnugg-conditions-grid">
            <div className="fnugg-conditions-grid__cell">A</div>
            <div className="fnugg-conditions-grid__cell fnugg-temperature">
                {formatTemperature( resort.temperature )}
            </div>
            <div className="fnugg-conditions-grid__cell">C</div>
            <div className="fnugg-conditions-grid__cell">D</div>
        </footer>
    </article> );
};

export default Resort;
