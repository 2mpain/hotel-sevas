import { useState } from "react";
import "../../../../css/index.css";
import { Button } from "@/Components/readyToUse/button";
import { motion } from "framer-motion";
import { animate } from "@/utils/animate";
import { cardsData } from "./data";
import { CustomDialog } from "@/Components/Dialog/CustomDialog";
import {
    Dialog,
    DialogContent,
    DialogDescription,
    DialogFooter,
    DialogHeader,
    DialogTitle,
    DialogTrigger,
} from "@/Components/readyToUse/dialog";
import { Input } from "@/Components/readyToUse/input";
import { Label } from "@/Components/readyToUse/label";

interface CardProps {
    onSubmit: (form: any) => void;
}

export function Cards({ onSubmit }: CardProps) {
    const [showDialog, setShowDialog] = useState(false);

    return (
        <>
            <motion.div
                id="rooms"
                initial="hidden"
                whileInView="visible"
                viewport={{ amount: 0.2 }}
                custom={1}
                variants={animate(0, 60)}
                className="my-10"
            >
                <h1 className="mt-4 scroll-m-20 text-4xl font-extrabold tracking-tight lg:text-5xl shadow-sm">
                    Наши номера
                </h1>
            </motion.div>
            <motion.div className="grid grid-cols-1 md:grid-cols-2 gap-1">
                {cardsData.map((card, index) => (
                    <div
                        className="card bg-gray-50 dark:bg-slate-900 hover:bg-gray-100 dark:hover:bg-gray-950 dark:hover:text-black "
                        key={index}
                    >
                        <motion.img
                            initial="hidden"
                            whileInView="visible"
                            viewport={{ amount: 0.2 }}
                            custom={index}
                            variants={
                                index % 2 == 0
                                    ? animate(-100, 0)
                                    : animate(100, 0)
                            }
                            src={card.image}
                            alt={card.title}
                            className="image rounded-sm md:w-150 w-full"
                        />
                        <motion.div
                            initial="hidden"
                            whileInView="visible"
                            viewport={{ amount: 0.2 }}
                            custom={index}
                            variants={
                                index % 2 == 0
                                    ? animate(-100, 0)
                                    : animate(100, 0)
                            }
                            className="title dark:text-white"
                        >
                            <h2 className="scroll-m-20 border-b pb-2 text-3xl font-bold tracking-tight first:mt-0 shadow-sm">
                                {card.title}
                            </h2>
                        </motion.div>
                        <div className="description dark:text-white">
                            <p className="leading-7 [&:not(:first-child)]:mt-6 my-2">
                                {card.description}
                            </p>
                        </div>

                        <div className="my-2 ">
                            <ul
                                role="list"
                                className="space-y-2 text-gray-500 dark:text-gray-400"
                            >
                                {card.services.map((service, serviceIndex) => (
                                    <li
                                        key={serviceIndex}
                                        className="flex space-x-2 items-center text-start"
                                    >
                                        <svg
                                            className="flex-shrink-0 w-3.5 h-3.5 text-blue-600 dark:text-blue-500"
                                            aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg"
                                            fill="currentColor"
                                            viewBox="0 0 20 20"
                                        >
                                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                                        </svg>
                                        <span className="leading-tight">
                                            {service}
                                        </span>
                                    </li>
                                ))}
                            </ul>
                        </div>

                        {/* dialog for ordering the hotel room */}
                        <CustomDialog onFormSubmit={onSubmit} />
                    </div>
                ))}
            </motion.div>
        </>
    );
}
