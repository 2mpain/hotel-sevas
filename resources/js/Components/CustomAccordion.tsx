import { Accordion, AccordionContent, AccordionItem, AccordionTrigger } from "@/Components/readyToUse/accordion"
import { motion } from "framer-motion"
import { accordionData } from "../Pages/MainPage/data/data"
import { animate } from '../utils/animate'

export function CustomAccordion () {
    return(
        <div className="w-full md:w-3/5 py-8" id="questions">
        <Accordion type="single" collapsible>
          {accordionData.map((item, index) => (
            <div
              key={item.id}
            >
              <AccordionItem key={item.id} value={item.id}>
                <AccordionTrigger>{item.title}</AccordionTrigger>
                <AccordionContent>{item.content}</AccordionContent>
              </AccordionItem>
            </div>
          ))}
        </Accordion>
      </div>
    )
}