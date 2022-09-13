import React from 'react';
import { Route, Switch } from 'react-router-dom';

import { PrivateRoute } from '../shared/components/utils-components/PrivateRoute';
// import { ROLE_ADMIN } from '../shared/constants/rolesConstant';
import * as URL from '../shared/constants/urls/urlConstants';
import { customHistory } from '../shared/services/historyServices';
import AccountUserView from '../views/AccountUserView';
import AccountUserViewModification from '../views/AccountUserViewModification';
import AddProductView from '../views/AddProductView';
import AdminHomeView from '../views/AdminHomeView';
import HomeView from '../views/HomeView';
import LoginView from '../views/LoginView';
import ShowView from '../views/ShowUserView';
import testView from '../views/testView';
import UpDateProductView from '../views/UpDateProdcutView';
import AdvancedSearchView from './../views/AdvancedSearchView';
import CartView from './../views/CartView';
import ContactView from './../views/ContactView';
import ErrorView from './../views/ErrorView';
import ListView from './../views/ListView';
import SearchView from './../views/SearchResultView';
import SingleView from './../views/SingleProductView';

/**
 * Routes of the application
 * with public and private route
 *
 * @author Peter Mollet
 */
const Routes = () => {
    return (
        <Switch history={customHistory}>
            <Route exact path={URL.URL_HOME} component={ListView} />
            <Route exact path={URL.URL_ADMIN_HOME} component={AdminHomeView} />
            <Route
                path={URL.URL_FORMADMIN_MODIFICATION}
                component={AccountUserViewModification}
            />
            <Route path={URL.URL_LOGIN} component={LoginView} />
            <Route path={URL.URL_REGISTER} component={AccountUserView} />
            <Route path={URL.URL_LIST} component={ListView} />
            <Route path={URL.URL_CONTACT} component={ContactView} />
            <Route
                path={URL.URL_PRODUCT + '/search=:searchTerm'}
                component={SearchView}
            />

            <Route path={URL.URL_PRODUCT + '/productid=:id'} component={SingleView} />
            <Route exact path={URL.URL_ADV_SEARCH} component={AdvancedSearchView} />
            <Route path={URL.URL_SHOW} component={ShowView} />
            <Route path={URL.URL_ADD_PRODUCT} component={AddProductView} />
            <Route path={URL.URL_UP_DATE_PRODUCT} component={UpDateProductView} />

            <Route path={URL.URL_TEST} component={testView} />
            <Route path="/cart" component={CartView} />

            <Route path={URL.URL_PRODUCT + '/productid=:id'} component={SingleView} />
            <Route exact path={URL.URL_ADV_SEARCH} component={AdvancedSearchView} />
            <Route path="*" component={ErrorView} />
            <Route path={URL.URL_HOME} component={HomeView} />
        </Switch>
    );
};

export default Routes;
