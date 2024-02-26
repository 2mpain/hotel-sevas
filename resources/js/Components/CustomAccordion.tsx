import { Accordion, AccordionItem, AccordionTrigger, AccordionContent } from "@/Components/readyToUse/accordion"
import { motion } from "framer-motion"
import {animate} from '../utils/animate'
import { accordionData } from "../Pages/MainPage/data/data"

export function CustomAccordion () {
    return(
        <div className="w-full md:w-3/5 py-8" id="questions">
        <Accordion type="single" collapsible>
          {accordionData.map((item, index) => (
            <motion.div
              key={item.id}
              custom={index}
              initial="hidden"
              //animate="visible"
              whileInView="visible"
              variants={animate(-100, 0)}
            >
              <AccordionItem key={item.id} value={item.id}>
                <AccordionTrigger>{item.title}</AccordionTrigger>
                <AccordionContent>{item.content}</AccordionContent>
              </AccordionItem>
            </motion.div>
          ))}
        </Accordion>
      </div>
    )
}