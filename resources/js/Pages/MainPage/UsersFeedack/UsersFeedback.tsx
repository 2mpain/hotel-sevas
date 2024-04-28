import { Header } from "@/Components/Header";
import { } from "framer-motion";
import { animate } from "../../../utils/animate";
import { authors } from "./data";

export function UsersFeedback() {
    return (
        <>
            <div
                className="flex justify-center items-center py-8"
            >
                <Header title="Отзывы наших клиентов" id="feedbacks" />
            </div>

            <div className="grid mb-8  rounded-lg shadow-lg md:mb-12 md:grid-cols-2">
                {authors.map((item, index) => (
                    <figure
                        key={index}
                        className="flex flex-col items-center justify-center p-8 text-center bg-white border-b border-r border-gray-200 rounded-md dark:bg-slate-900 dark:border-gray-700"
                    >
                        <blockquote className="max-w-2xl mx-auto mb-4 text-gray-500 lg:mb-8 dark:text-gray-400">
                            <h3 className="text-lg font-semibold text-gray-900 dark:text-white">
                                {item.quote}
                            </h3>
                            <p className="my-4">{item.description}</p>
                        </blockquote>
                        <figcaption className="flex items-center justify-center space-x-3">
                            <img
                                className="rounded-full w-11 h-11"
                                src={item.image}
                                alt="profile picture"
                            />
                            <div className="space-y-0.5 font-medium dark:text-white text-left">
                                <div>{item.name}</div>
                                <div className="text-sm text-gray-500 dark:text-gray-400">
                                    {item.role}
                                </div>
                            </div>
                        </figcaption>
                    </figure>
                ))}
            </div>
        </>
    );
}
