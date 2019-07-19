import React from 'react';
import clsx from 'clsx';
import {makeStyles} from '@material-ui/core/styles';
import CssBaseline from '@material-ui/core/CssBaseline';
import Drawer from '@material-ui/core/Drawer';
import AppBar from '@material-ui/core/AppBar';
import Toolbar from '@material-ui/core/Toolbar';
import Typography from '@material-ui/core/Typography';
import Divider from '@material-ui/core/Divider';
import IconButton from '@material-ui/core/IconButton';
import Badge from '@material-ui/core/Badge';
import Container from '@material-ui/core/Container';
import Link from '@material-ui/core/Link';
import MenuIcon from '@material-ui/icons/Menu';
import ChevronLeftIcon from '@material-ui/icons/ChevronLeft';
import NotificationsIcon from '@material-ui/icons/Notifications';
import Navigation from "./Navigation";
import Grid from '@material-ui/core/Grid';
import {Route, BrowserRouter, Switch} from "react-router-dom";
import Users from './pages/Users';

function MadeWithLove() {
	return (
		<Typography variant="body2" color="textSecondary" align="center">
			{'Built with love by the '}
			<Link color="inherit" href="https://ikdev.eu/">
				ikdev
			</Link>
			{' team.'}
		</Typography>
	);
}

const drawerWidth = 300;

const useStyles = makeStyles(theme => ({
	root: {
		display: 'flex',
	},
	toolbar: {
		paddingRight: 24, // keep right padding when drawer closed
	},
	toolbarIcon: {
		display: 'flex',
		alignItems: 'center',
		justifyContent: 'flex-end',
		padding: '0 8px',
		...theme.mixins.toolbar,
	},
	appBar: {
		zIndex: theme.zIndex.drawer + 1,
		transition: theme.transitions.create(['width', 'margin'], {
			easing: theme.transitions.easing.sharp,
			duration: theme.transitions.duration.leavingScreen,
		}),
	},
	appBarShift: {
		marginLeft: drawerWidth,
		width: `calc(100% - ${drawerWidth}px)`,
		transition: theme.transitions.create(['width', 'margin'], {
			easing: theme.transitions.easing.sharp,
			duration: theme.transitions.duration.enteringScreen,
		}),
	},
	menuButton: {
		marginRight: 30,
	},
	menuButtonHidden: {
		display: 'none',
	},
	title: {
		flexGrow: 1,
	},
	drawerPaper: {
		position: 'relative',
		whiteSpace: 'nowrap',
		width: drawerWidth,
		transition: theme.transitions.create('width', {
			easing: theme.transitions.easing.sharp,
			duration: theme.transitions.duration.enteringScreen,
		}),
	},
	drawerPaperClose: {
		overflowX: 'hidden',
		transition: theme.transitions.create('width', {
			easing: theme.transitions.easing.sharp,
			duration: theme.transitions.duration.leavingScreen,
		}),
		width: theme.spacing(7),
		[theme.breakpoints.up('sm')]: {
			width: theme.spacing(9),
		},
	},
	appBarSpacer: theme.mixins.toolbar,
	content: {
		flexGrow: 1,
		height: '100vh',
		overflow: 'auto',
	},
	container: {
		paddingTop: theme.spacing(4),
		paddingBottom: theme.spacing(4),
	},
	paper: {
		padding: theme.spacing(2),
		display: 'flex',
		overflow: 'auto',
		flexDirection: 'column',
	},
	fixedHeight: {
		height: 300,
	},
}));

export default function Dashboard() {
	const classes = useStyles();
	const [open, setOpen] = React.useState(true);
	const handleDrawerOpen = () => {
		setOpen(true);
	};
	const handleDrawerClose = () => {
		setOpen(false);
	};
	
	return (
		<div className={classes.root}>
			<BrowserRouter>
				<CssBaseline/>
				<AppBar position="absolute" className={clsx(classes.appBar, open && classes.appBarShift)}
				        style={{backgroundColor: '#2c2c2c'}}>
					<Toolbar className={classes.toolbar}>
						<Grid container spacing={2}>
							<Grid item sm={8}>
								<IconButton
									edge="start"
									color="inherit"
									aria-label="Open drawer"
									onClick={handleDrawerOpen}
									className={clsx(classes.menuButton, open && classes.menuButtonHidden)}>
									<MenuIcon/>
								</IconButton>
								<img
									src={`${location.protocol}//${location.hostname}/ikpanel/assets/img/logo_white.png`}
									style={{maxWidth: 100, paddingTop: 10}}/>
							</Grid>
							<Grid item sm={4} style={{textAlign: 'right'}}>
								<IconButton color="inherit">
									<Badge badgeContent={4} color="secondary">
										<NotificationsIcon/>
									</Badge>
								</IconButton>
							</Grid>
						</Grid>
					</Toolbar>
				</AppBar>
				<Drawer variant="permanent" classes={{
					paper: clsx(classes.drawerPaper, !open && classes.drawerPaperClose),
				}} open={open}>
					<div className={classes.toolbarIcon}>
						<IconButton onClick={handleDrawerClose}>
							<ChevronLeftIcon/>
						</IconButton>
					</div>
					<Divider/>
					<Navigation/>
				</Drawer>
				<main className={classes.content}>
					<div className={classes.appBarSpacer}/>
					<Container maxWidth="lg" className={classes.container} style={{
						backgroundImage: `url(${location.protocol}//${location.hostname}/ikpanel/assets/img/logo.png)`,
						backgroundRepeat: 'no-repeat',
						backgroundPosition: 'center',
						minHeight: '500px'
					}}>
						<Switch>
							<Route path="/admin/react/users" component={Users}/>
						</Switch>
					</Container>
					<MadeWithLove/>
				</main>
			</BrowserRouter>
		</div>
	);
}