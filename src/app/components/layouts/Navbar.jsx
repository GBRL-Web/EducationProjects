/* eslint-disable jsx-a11y/anchor-is-valid */
import { faBagShopping, faUser } from '@fortawesome/free-solid-svg-icons';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome';
import { Disclosure, Menu, Transition } from '@headlessui/react';
import { SearchIcon } from '@heroicons/react/outline';
import React, { useEffect, useState } from 'react';
import { Fragment } from 'react';
import { Link } from 'react-router-dom';

// import logo
import logo from '../../assets/images/braka_black.png'; // with import
import CartMenu from '../../shared/components/container/CartMenu';
import { isAuthenticated } from '../../shared/services/accountServices';
import {
    URL_FORMADMIN_MODIFICATION,
    URL_LOGIN,
    URL_REGISTER,
} from './../../shared/constants/urls/urlConstants';

// Navbar components and links
const navigation = [
    { name: 'Homme', href: '/product/men', current: false },
    { name: 'Femme', href: '/product/women', current: false },
    { name: 'Enfants', href: '/product/teen', current: false },
    { name: 'Bébé', href: '/product/baby', current: false },
];

function classNames(...classes) {
    return classes.filter(Boolean).join(' ');
}

// Navbar component
export default function Navbar() {
    const [searchTerm, setSearchTerm] = useState('');
    const [isShown, setIsShown] = useState(false);

    function enterQuery(e) {
        if (e.key === 'Enter') {
            window.open('/product/search=' + searchTerm.toLowerCase(), '_self');
        }
    }
    function clickQuery() {
        window.open('/product/search=' + searchTerm.toLowerCase(), '_self');
    }

    function advSearchToggle() {
        if (window.location.pathname != '/product/adv-search') {
            return true;
        } else {
            return false;
        }
    }

    function logout() {
        localStorage.removeItem('token');
        window.open('http://localhost:3000', '_self');
    }

    // const userToken = localStorage.getItem('token').substring(0, 36);
    // const cartItems = localStorage.getItem('cart-local-' + userToken);
    // console.log('Cart items = ' + cartItems);
    useEffect(() => {}, []);

    // Toggle cart item bar
    function toggleCart() {
        setIsShown(!isShown);
    }

    return (
        // Main navbar settings
        <Disclosure as="nav" className="bg-white">
            <div className="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8 ">
                <div className="relative flex items-center justify-between h-32">
                    <div className="flex-1 flex items-center justify-center sm:items-stretch mt-4">
                        <div className="sm:block sm:ml-6 md:w-full lg:w-full">
                            <div className="flex md:justify-evenly place-content-around mb-4">
                                {/* Logo */}
                                <div className="sm:w-2/5 md:w-1/4 lg:w-1/4 px-10 lg:ml-8 h-12">
                                    <a href="/">
                                        <img src={logo} alt="logo Braka" />
                                    </a>
                                </div>

                                {/* Search input with search svg */}
                                <div className="px-10 relative text-base bg-transparent w-2/5 lg:ml-10">
                                    <div className="hidden sm:flex items-center border-b-2 py-2">
                                        {/* Search input area */}
                                        <input
                                            className="input-menu-search outline-none"
                                            type="text"
                                            placeholder="Search..."
                                            onChange={(e) => {
                                                setSearchTerm(e.target.value);
                                            }}
                                            onKeyPress={enterQuery}
                                        ></input>

                                        {/* Search icon - button */}
                                        <button
                                            type="submit"
                                            className="absolute right-0 top-0 mt-3 mr-4"
                                            onClick={clickQuery}
                                        >
                                            <SearchIcon
                                                className="block h-6 w-full"
                                                aria-hidden="true"
                                            />
                                        </button>
                                    </div>
                                </div>
                                {advSearchToggle() ? (
                                    <p className="py-3 rounded-md text-sm font-medium">
                                        <a href="/product/adv-search">Advanced Search</a>
                                    </p>
                                ) : (
                                    ''
                                )}
                                {/* Notifications icon */}
                                <div className="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:pr-0 ">
                                    {/* Profile dropdown */}
                                    <Menu as="div" className="lg:ml-40 lg:mr-10 relative">
                                        <div>
                                            <Menu.Button className="flex sm:text-sm focus:outline-none text-teal-400 focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white">
                                                <span className="sr-only ">
                                                    Open user menu
                                                </span>
                                                <FontAwesomeIcon
                                                    icon={faUser}
                                                    size="3x"
                                                />
                                            </Menu.Button>
                                        </div>
                                        <Transition
                                            as={Fragment}
                                            enter="transition ease-out duration-100"
                                            enterFrom="transform opacity-0 scale-95"
                                            enterTo="transform opacity-100 scale-100"
                                            leave="transition ease-in duration-75"
                                            leaveFrom="transform opacity-100 scale-100"
                                            leaveTo="transform opacity-0 scale-95"
                                        >
                                            <Menu.Items className="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                                                <Menu.Item>
                                                    {({ active }) => (
                                                        <Link to={URL_LOGIN}>
                                                            <div
                                                                className={classNames(
                                                                    active
                                                                        ? 'bg-gray-100'
                                                                        : '',
                                                                    'block px-4 py-2 text-sm text-gray-700 link',
                                                                )}
                                                            >
                                                                Login
                                                            </div>
                                                        </Link>
                                                    )}
                                                </Menu.Item>

                                                <Menu.Item>
                                                    {({ active }) => (
                                                        <Link to={URL_REGISTER}>
                                                            <div
                                                                className={classNames(
                                                                    active
                                                                        ? 'bg-gray-100'
                                                                        : '',
                                                                    'block px-4 py-2 text-sm text-gray-700 link',
                                                                )}
                                                            >
                                                                Create account
                                                            </div>
                                                        </Link>
                                                    )}
                                                </Menu.Item>

                                                {isAuthenticated() && (
                                                    <Menu.Item>
                                                        {({ active }) => (
                                                            <Link
                                                                to={
                                                                    URL_FORMADMIN_MODIFICATION
                                                                }
                                                            >
                                                                <div
                                                                    className={classNames(
                                                                        active
                                                                            ? 'bg-gray-100'
                                                                            : '',
                                                                        'block px-4 py-2 text-sm text-gray-700 link',
                                                                    )}
                                                                >
                                                                    Modification account
                                                                </div>
                                                            </Link>
                                                        )}
                                                    </Menu.Item>
                                                )}

                                                {isAuthenticated() && (
                                                    <Menu.Item>
                                                        {({ active }) => (
                                                            <div
                                                                onClick={logout}
                                                                className={classNames(
                                                                    active
                                                                        ? 'bg-gray-100'
                                                                        : '',
                                                                    'block px-4 py-2 text-sm text-gray-700 link',
                                                                )}
                                                            >
                                                                Logout
                                                            </div>
                                                        )}
                                                    </Menu.Item>
                                                )}
                                            </Menu.Items>
                                        </Transition>
                                    </Menu>

                                    {/* Shopping cart ddown */}

                                    <Menu as="div">
                                        <div>
                                            <Menu.Button
                                                className="flex sm:text-sm focus:outline-none text-teal-400"
                                                onClick={() => setIsShown(!isShown)}
                                            >
                                                <span className="sr-only ">
                                                    Open shopping cart
                                                </span>
                                                <FontAwesomeIcon
                                                    icon={faBagShopping}
                                                    size="3x"
                                                />
                                            </Menu.Button>
                                        </div>
                                        <CartMenu
                                            cartState={isShown}
                                            toggleCart={toggleCart}
                                            setShown={setIsShown}
                                        />

                                        {/* </Transition> */}
                                    </Menu>
                                </div>
                            </div>
                            <div className="hidden sm:flex place-content-around mb-4">
                                {/* menu men women kid babies */}
                                {navigation.map((item) => (
                                    <a
                                        key={item.name}
                                        href={item.href}
                                        className={classNames(
                                            item.current
                                                ? ''
                                                : 'hover:font-bold hover:scale-125 ease-in duration-200 hover:bg-teal-300',
                                            'px-3 py-2 text-sm font-medium ',
                                        )}
                                        aria-current={item.current ? 'page' : undefined}
                                    >
                                        {item.name}
                                    </a>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Disclosure>
    );
}
