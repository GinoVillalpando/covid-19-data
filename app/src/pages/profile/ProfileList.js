import React from 'react';
import { Route } from 'react-router';

const ProfileListComponent = ({profiles}) => {

	return (
		<Route render={ ({history}) => (
			<tbody>
			{profiles.map(profile => (
				<tr key={profile.id} onClick={() => {history.push(`profile/${profile.id}`)}}>
					<td>{profile.id}</td>
					<td>{profile.profileUsername}</td>
					<td>{profile.profileEmail}</td>
					<td>{profile.profilePhone}</td>
					<td>{profile.profileAvatarUrl}</td>
				</tr>
			))}
			</tbody>
		)}/>
	)
};

export const ProfileList = (ProfileListComponent);