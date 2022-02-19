import React from "react";
import {Link} from "react-router-dom";
import {Flip, toast, ToastContainer} from 'react-toastify';
import axios from "axios";

const API_URL = window.location.protocol + "//" + window.location.host + "/api/v1/lefts/";

class Index extends React.Component {
    constructor(props, context) {
        super(props, context);
        this.state = {
            isLoading: true,
            menu: ""
        };
    }

    async componentDidMount() {
        this._isMounted = true;
        const response = await axios.get(API_URL + 'index');
        if (response.data.status) {
            this.setState({menu: response.data.menu, isLoading: false});
        } else {
            toast.error(response.data.message);
        }
    }
    render() {
        const {menu} = this.state;
        return (
            <ul className="metismenu list-unstyled" id={'side-menu'}>
                {
                    menu?.length > 0 && menu.map((item, key) => {
                        return (
                            <li key={key}>
                                <a href={item?.children?.length === 0 ? item.url : "#"} className={item?.children?.length > 0 ? "has-arrow waves-effect" : "waves-effect"} aria-expanded={false}>
                                    <i className={"nav-icon "+item.icon}/>
                                    {item.name}
                                </a>
                                <ul className="sub-menu mm-collapse">
                                    {
                                        item?.children?.length > 0 && item.children.map((child, childKey) => {
                                            return (
                                                <li key={childKey}>
                                                    <a href={child.url}>
                                                        <i className={"nav-icon "+child.icon}/>
                                                        {child.name}
                                                    </a>
                                                </li>
                                            )
                                        })
                                    }
                                </ul>
                            </li>
                        )
                    })
                }
            </ul>

        );
    }
}

export default Index;
