import React from 'react';

import { ROLE_ADMIN } from './../shared/constants/rolesConstant';
import { URL_ADMIN_HOME } from './../shared/constants/urls/urlConstants';
import { hasRole } from './../shared/services/accountServices';

const HomeView = ({ customHistory }) => {
    return (
        <div>
            <p className="text-primary font-extrabold">HOME</p>

            {hasRole(ROLE_ADMIN) && (
                <button
                    className="btn btn-primary"
                    onClick={() => customHistory.push(URL_ADMIN_HOME)}
                >
                    Admin
                </button>
            )}
        </div>
    );
};

export default HomeView;
