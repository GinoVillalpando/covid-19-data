import React from 'react';
import { Route } from 'react-router';
import Card from "react-bootstrap/Card";
import {BehaviorList} from "../behavior/BehaviorList";
import {BehaviorPost} from "../../shared/components/behavior-post/BehaviorPost";
import CardActionArea from '@material-ui/core/CardActionArea';
import CardActions from '@material-ui/core/CardActions';
import CardContent from '@material-ui/core/CardContent';
import CardMedia from '@material-ui/core/CardMedia';
import Button from '@material-ui/core/Button';
import Typography from '@material-ui/core/Typography';

// import logo from "./../images/recipe-placeholder.jpg";



export const Business = ({business,behaviors, votes}) => {
	return (

//this gives form to the recipes in the list on DOM
		<Route render={ ({history}) => (


			<>

			{/* <img src ={business.businessAvatar} alt=""/> */}
		
			
			<Card className="my-5 border border-dark alternate-bg ml-5 ">
				<div className ="row d-flex-column"> 
					<a className="ml-5 p-2 align-self-center" href={business.businessUrl}> 
						<Card.Title className="ml-5 p-2 align-self-center">{business.businessName}</Card.Title>
					</a>
				</div>
				<CardMedia className="align-self-center">
					<img height="300" width="350" src={business.businessAvatar} alt="business"/> 
				</CardMedia>

				<a href={business.businessUrl} class="d-flex justify-content-center align-items-center">Yelp Link for business</a>
				<Card.Body className="row my-3 px-5">
				<div className="col-4 pt-5" style={{width:25}}>
					<BehaviorPost behaviorBusinessId = {business.businessId}/>
				</div>
					<div style={{width: 50, order: 1}} className="col-8">
						<BehaviorList behaviors={behaviors} />
					</div>
				</Card.Body>
			</Card>

			</>
		)}/>
	)
};