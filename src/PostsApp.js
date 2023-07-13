import React from 'react';
import { Spinno } from 'spinno';

class PostsApp extends React.Component {
	constructor( props ) {
		super( props );

		this.state = {
			postLists: [],
			loading: true,
		};
	}

	getDecodedString = ( str ) => {
		const txt = document.createElement( 'textarea' );
		txt.innerHTML = str;
		return txt.value;
	};

	componentDidMount() {
		this.setState( { loading: true } );

		fetch( DTN_POSTS.rest_url, {
			method: 'GET',
			credentials: 'same-origin',
		} )
			.then( ( response ) => response.json() )
			.then( ( postLists ) => {
				this.setState( { postLists, loading: false } );
			} );
	}

	render() {
		return (
			<>
				{ this.state.loading && <Spinno /> }
				{ this.state.postLists.length > 0 && (
					<ul>
						{ this.state.postLists.map( ( item ) => {
							return (
								<li key={ item.title }>
									<a
										href={ item.url }
										target="_blank"
										rel="noreferrer"
									>
										{ this.getDecodedString( item.title ) }
									</a>
								</li>
							);
						} ) }
					</ul>
				) }
			</>
		);
	}
}

export default PostsApp;
