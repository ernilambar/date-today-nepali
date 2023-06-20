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
		const data = new FormData();

		this.setState( { loading: true } );

		data.append( 'action', DTN_POSTS.posts_action );

		fetch( DTN_POSTS.ajax_url, {
			method: 'POST',
			credentials: 'same-origin',
			body: data,
		} )
			.then( ( response ) => response.json() )
			.then( ( resp ) => {
				this.setState( { postLists: resp.data, loading: false } );
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
