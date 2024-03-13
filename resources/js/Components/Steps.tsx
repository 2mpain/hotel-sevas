import React from "react";
import { motion } from "framer-motion";
import { Header } from "./Header";

interface Step {
  number: number;
  title: string;
  description: string;
  active?: boolean;
}

interface StepperProps {
  steps: Step[];
}

export const Stepper: React.FC<StepperProps> = ({ steps }) => {
  const listVariants = {
    hidden: {},
    visible: {
      transition: {
        when: "beforeChildren",
        staggerChildren: 0.2,
      },
    },
  };

  const itemVariants = {
    hidden: { opacity: 0, x: -20 },
    visible: { opacity: 1, x: 0 },
  };

  return (
    <div className="py-8">
     <Header title="Заезд в 3 шага!" id="steps"/>
     <div className="flex-1 justify-center items-center mt-8">
      <motion.ol
        initial="hidden"
        whileInView="visible"
        variants={listVariants}
        className="items-center w-full space-y-4 sm:flex sm:space-x-8 sm:space-y-0"
      >
        {steps.map((step, index) => (
          <motion.li
            key={index}
            className={`flex items-center my-2 space-x-2.5 ${
              step.active
                ? "text-blue-600 dark:text-blue-500"
                : "text-gray-500 dark:text-gray-400"
            }`}
            variants={itemVariants}
          >
            <span className="flex items-center justify-center w-8 h-8 border rounded-full shrink-0">
              {step.number}
            </span>
            <span>
              <h3 className="font-medium leading-tight">{step.title}</h3>
              <p className="text-sm">{step.description}</p>
            </span>
          </motion.li>
        ))}
      </motion.ol>
      </div>
      </div>
   
  );
};

export default Stepper;
