import "../../../css/index.css";
import { motion } from "framer-motion";
import { Cards } from "@/Pages/MainPage/Cards/Cards";
import { UsersFeedback } from "@/Pages/MainPage/UsersFeedack/UsersFeedback";
import Stepper from "@/Components/Steps";
// import { SignIn } from "./signin";
import { Footer } from "@/Pages/MainPage/Footer/Footer";
import { HeaderParagraph } from "@/Pages/MainPage/HeaderParagraph";
import { steps } from "@/Pages/MainPage/data/data";
import { CustomAccordion } from "@/Components/CustomAccordion";
import MainHeader from "@/Components/Header/Header";
import ContactUs from "@/Pages/MainPage/ContactUs/ContactUs";
import { Head } from "@inertiajs/react";
import { AlertComp } from "@/Components/Alert";
import { useState, useEffect } from "react";
import { z } from "zod";
import { router } from "@inertiajs/react";

export function MainPage() {
    const [showAlert, setShowAlert] = useState(false);

    const handleRoomBookingFormSubmit = (form: any) => {
        router.post("/customers", form.getValues());
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
                <ContactUs setShowAlert={setShowAlert}/>

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
