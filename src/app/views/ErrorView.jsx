import React from 'react';

import shrug from './../assets/images/shrug.png';

export default function ErrorView() {
    return (
        <div className="flex h-screen items-center text-center bg-[url('/src/app/assets/images/street-art_retouchee.png')]">
            <div className="mx-auto">
                <div className="bg-red-600 w-[500px] rounded-[20px] outline-4 outline-white outline-offset-2 outline bg-opacity-30">
                    <h1 className="text-white">Page does not exist.</h1>
                    <h3 className="text-orange-300">
                        <a href="/">Return to the homepage</a>
                        <img className="mx-auto" src={shrug} alt="Idk man." />
                    </h3>
                </div>
            </div>
        </div>
    );
}
