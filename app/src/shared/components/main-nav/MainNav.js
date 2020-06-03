import React, {useState} from "react";
import Navbar from "react-bootstrap/Navbar";
import Nav from "react-bootstrap/Nav";
import {LinkContainer} from "react-router-bootstrap";
import {Form, FormControl, Button} from "react-bootstrap";
import {SignUpModal} from "./sign-up/SignUpModal";
import {SignInModal} from "./sign-in/SignInModal";
import { SearchFormContent } from "../SearchForm/SearchForm";
//import {BehaviorList} from "../../../pages/behavior/BehaviorList";
//import {Profile} from "../../../pages/profile/Profile"
 


export const MainNav = (props) => {

	const [searchWord, setSearchWord] = useState('');

	const setSearch = (e) => {
		e.preventDefault();
		//check the input field for which characters are being entered and set them as the search term
		setSearchTerm(e.target.value);
	};
	
	return(
		<Navbar bg="primary" variant="dark">
			<LinkContainer exact to="/" >
				<Navbar.Brand>Pan-Ops</Navbar.Brand>
			</LinkContainer>
			<Nav className="mr-auto">
				<LinkContainer exact to="/Profile">
					<Nav.Link>profile</Nav.Link>
				</LinkContainer>
				<SignUpModal/>
				<SignInModal/>
				<LinkContainer exact to="/image"
				><Nav.Link>image</Nav.Link>
				</LinkContainer>
			</Nav>
			{/*<label htmlFor="search">Search by Business Name</label>*/}
			{/*<input type="text" value ={props.inputValue} onChange={props.businessFilterOnChange}/>*/}

			<SearchFormContent searchWord={searchWord} setSearchWord={setSearchWord} onChange={setSearch}/>
		</Navbar>
	)
};