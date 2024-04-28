import Stepper from "@/Components/Steps";
import { Cards } from "@/Pages/MainPage/Cards/Cards";
import { UsersFeedback } from "@/Pages/MainPage/UsersFeedack/UsersFeedback";
import { motion } from "framer-motion";
import "../../../css/index.css";
// import { SignIn } from "./signin";
import { AlertComp } from "@/Components/Alert";
import { CustomAccordion } from "@/Components/CustomAccordion";
import MainHeader from "@/Components/Header/Header";
import ContactUs from "@/Pages/MainPage/ContactUs/ContactUs";
import { Footer } from "@/Pages/MainPage/Footer/Footer";
import { HeaderParagraph } from "@/Pages/MainPage/HeaderParagraph";
import { steps } from "@/Pages/MainPage/data/data";
import { Head, router } from "@inertiajs/react";
import { EyeClosedIcon, RocketIcon } from "@radix-ui/react-icons";
import axios from "axios";
import { ReactNode, useEffect, useState } from "react";
import { z } from "zod";

export function MainPage() {
    const [showAlert, setShowAlert] = useState(false);
    const [alertData, setAlertData] = useState({
        title: "",
        description: "",
        icon: "" as ReactNode,
    });

    const handleRoomBookingFormSubmit = async (form: any) => {
        await axios
            .post("api/customer/create-customer", form.getValues())
            .then((response) => {
                console.log(response.data);
                setAlertData({
                    title: "Успешно!",
                    description: "Ожидайте обратной связи",
                    icon: <RocketIcon />,
                });
            })
            .catch((error) => {
                setAlertData({
                    title: "Упс. Что-то пошло не так",
                    description: "Попробуйте позже.",
                    icon: <EyeClosedIcon />,
                });
            })
            .finally(() => {
                setShowAlert(true);
            });
    };

    useEffect(() => {
        if (showAlert) {
            setTimeout(() => {
                setShowAlert(false);
            }, 3000);
        }
    }, [showAlert]);

    return (
        <>
            <Head title="Главная" />
            <MainHeader />
            <div
                className="flex flex-col  ml-2 mr-2 justify-center items-center "
            >
                {/* hotel image w/ title, rent button & calendar */}
                <HeaderParagraph showCalendar={false} />

                {/* <SignIn /> */}

                {/* users's feedbacks section */}
                <UsersFeedback />

                {/* data accordion */}
                <CustomAccordion />

                {/*how to visit us steps */}
                <Stepper steps={steps} />

                {/* hotel rooms cards */}
                <Cards onSubmit={handleRoomBookingFormSubmit} />

                {/* contact form */}
                <ContactUs
                    setShowAlert={setShowAlert}
                    setAlertData={setAlertData}
                />

                {/* website footer */}
                <Footer />

                {/* info alert */}
                {showAlert && (
                    <AlertComp
                        show
                        title={alertData.title}
                        description={alertData.description}
                        icon={alertData.icon}
                    />
                )}
            </div>
        </>
    );
}
