import { Button } from "@/Components/readyToUse/button";
import { DatePickerWithRange } from "@/Components/readyToUse/calendar-comp";
import { CursorArrowIcon } from "@radix-ui/react-icons";
import { motion } from "framer-motion";
import { useEffect, useState } from "react";
import "../../../css/index.css";
import { AlertComp } from "../../../js/Components/Alert";
import { animate } from "../../utils/animate";

interface HeaderParagraphProps {
    showCalendar: boolean;
}

export function HeaderParagraph({ showCalendar }: HeaderParagraphProps) {
    const [isShowCalendar, setIsShowCalendar] = useState(showCalendar);
    const [isShowAlert, setIsShowAlert] = useState(false);

    useEffect(() => {
        setTimeout(() => {
            setIsShowAlert(false);
        }, 3000);
    }, [isShowAlert]);

    const scrollToRooms = () => {
        const section = document.getElementById("rooms");
        if (section) {
            section.scrollIntoView({ behavior: "smooth" });
        }
    };
    return (
        <>
            <header className="header__main">
                <motion.div
                    custom={3}
                    variants={animate(0, 100)}
                    //className="section__container header__container"
                >
                    <h1 className="mb-8 scroll-m-20 text-4xl md:text-8xl font-extrabold tracking-tight text-white text-center">
                        Комфортное место
                        <br />
                        для Вашего отдыха
                    </h1>
                    <motion.div
                        custom={4}
                        variants={animate(0, 100)}
                        className="flex justify-center my-15"
                    >
                        <div className="flex flex-col justify-center items-center text-center w-full">
                            <Button
                                className="shadow-lg bg-white text-black hover:bg-black hover:text-white dark:bg-black dark:text-white dark:hover:bg-white dark:hover:text-black"
                                onClick={() => {
                                    setIsShowAlert(true);
                                    //setIsShowCalendar(!isShowCalendar);
                                    scrollToRooms();
                                }}
                            >
                                <CursorArrowIcon className="mr-2 h-4 w-4" />{" "}
                                Забронировать номер
                            </Button>

                            <DatePickerWithRange
                                className={`${
                                    isShowCalendar ? "opacity-1" : "opacity-0"
                                } my-2 text-black dark:bg-black dark:text-white`}
                            />
                        </div>
                    </motion.div>
                </motion.div>
            </header>

            {/* showing Alert if user clicked on rent */}
            {isShowAlert && (
                <AlertComp
                    show={isShowAlert}
                    title={"Отлично!"}
                    description={"Выберите понравившийся номер"}
                />
            )}
        </>
    );
}
