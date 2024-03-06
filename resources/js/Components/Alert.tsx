import { Alert, AlertDescription, AlertTitle } from "@/Components/readyToUse/alert";
import { Terminal } from "lucide-react";
import { motion} from "framer-motion";


const exitAnimation = {
  hidden: { opacity: 0, y: 20 },
  visible: { opacity: 1, y: 0 },
  exit: { opacity: 0, y: 20 },
};

interface AlertCompProps {
  show: boolean;
}

export function AlertComp({ show }: AlertCompProps) {
  return (
    <motion.div
      initial="hidden"
      animate={show ? "visible" : "exit"}
      exit="exit"
      variants={exitAnimation}
      className="fixed bottom-4 left-4 z-10"
    >
      <Alert>
        <Terminal className="h-4 w-4" />
        <AlertTitle>Отлично!</AlertTitle>
        <AlertDescription>Выберите дату заезда</AlertDescription>
      </Alert>
    </motion.div>
  );
}
