import {
    Alert,
    AlertDescription,
    AlertTitle,
} from "@/Components/readyToUse/alert";
import { RocketIcon } from "@radix-ui/react-icons";
import { motion } from "framer-motion";
import { ReactNode } from "react";

const exitAnimation = {
    hidden: { opacity: 0, y: 20 },
    visible: { opacity: 1, y: 0 },
    exit: { opacity: 0, y: 20 },
};

interface AlertCompProps {
    show: boolean;
    title: string;
    description: string;
    icon?: ReactNode;
}

export function AlertComp({
    show,
    title = "Отлично!",
    description,
    icon = <RocketIcon className="h-4 w-4" />,
}: AlertCompProps) {
    return (
        <motion.div
            initial="hidden"
            animate={show ? "visible" : "exit"}
            exit="exit"
            variants={exitAnimation}
            className="fixed bottom-4 left-4 z-10"
        >
            <Alert>
                {icon}
                <AlertTitle>{title}</AlertTitle>
                <AlertDescription>{description}</AlertDescription>
            </Alert>
        </motion.div>
    );
}
