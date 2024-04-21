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
import axios from "axios";
import { useEffect, useState } from "react";
import { z } from "zod";

export function MainPage() {
    const [showAlert, setShowAlert] = useState(false);

    const handleRoomBookingFormSubmit = (form: any) => {
        axios
            .post("api/customer/create-customer", form.getValues())
            .then((response) => {
                console.log(response.data);
            })
            .catch((error) => {
                throw new Error(error);
            });

        setShowAlert(true);
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
            <motion.div
                initial="hidden"
                whileInView="visible"
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
                <ContactUs setShowAlert={setShowAlert} />

                {/* website footer */}
                <Footer />

                {/* info alert */}
                {showAlert && (
                    <AlertComp
                        show
                        title="Успешно!"
                        description="Ожидайте обратной связи."
                    />
                )}
            </motion.div>
        </>
    );
}
