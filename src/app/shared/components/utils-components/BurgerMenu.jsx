import { slide as MenuBurger } from 'react-burger-menu';
import CloseImage from '../../../assets/images/croix.png';

export default function BurgerMenu() {
    return (
        // Pass on our props
        <MenuBurger customCrossIcon={<img src={CloseImage} />} {...props}>
            <a className="menu-item" href="/collection">
                Collection
            </a>
            <a className="menu-item" href="/femme">
                Femme
            </a>
            <a className="menu-item" href="/homme">
                Homme
            </a>
            <a className="menu-item" href="/enfant">
                Enfant
            </a>
            <a className="menu-item" href="/bebe">
                Bébé
            </a>
            <a className="menu-item" href="/accessoires">
                Accessoires
            </a>
            <a className="menu-item" href="/carteCadeau">
                Carte Cadeau
            </a>
            <a className="menu-item" href="/aPropos">
                A propos
            </a>
            <a className="menu-item" href="/contact">
                Contact
            </a>
            <a className="menu-item" href="/retour">
                Retour
            </a>
            <a className="menu-item" href="/besoinDAide">
                Besoin d'aide ?
            </a>
        </MenuBurger>
    );
}
